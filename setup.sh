#!/bin/bash

# setup.sh - Automates the setup of the PHP MVC Framework

# Exit on any error
set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color

# Check for required tools
echo "Checking for required tools..."
command -v composer >/dev/null 2>&1 || { echo -e "${RED}Composer is not installed. Please install Composer and try again.${NC}"; exit 1; }
command -v php >/dev/null 2>&1 || { echo -e "${RED}PHP is not installed. Please install PHP and try again.${NC}"; exit 1; }
command -v mysql >/dev/null 2>&1 || { echo -e "${RED}MySQL client is not installed. Please install MySQL and try again.${NC}"; exit 1; }

# Check for redirect issues in .env
echo "Checking for potential redirect issues..."
if grep -q "xtnd.localhost" .env 2>/dev/null; then
    echo -e "${RED}Warning: .env file contains 'xtnd.localhost'. This may cause redirects. Please update to 'http://localhost:<port>' in your configuration.${NC}"
fi

# Function to check if a port is free
check_port() {
    local port=$1
    if lsof -i :$port >/dev/null 2>&1; then
        return 1 # Port is in use
    else
        return 0 # Port is free
    fi
}

# Try to find an available port
echo "Checking for an available port..."
PORTS=(8080 8000 8081)
PORT=""
for port in "${PORTS[@]}"; do
    if check_port $port; then
        PORT=$port
        break
    else
        echo -e "${RED}Port $port is already in use. Trying next port...${NC}"
    fi
done

# If no port is available, exit
if [ -z "$PORT" ]; then
    echo -e "${RED}No available ports found (tried 8080, 8000, 8081). Please free up one of these ports or modify the script to try other ports.${NC}"
    echo "To check port usage:"
    echo "  On Linux/macOS: lsof -i :8080"
    exit 1
fi

# Install Composer dependencies
echo "Installing Composer dependencies..."
composer install

# Set up .env file
echo "Setting up environment file..."
if [ -f .env ]; then
    echo "Existing .env file found. Skipping creation."
else
    cp .env.example .env
    echo "Created .env file from .env.example"
fi

# Prompt for database configuration
echo "Please provide your database configuration."
read -p "Database host (default: localhost): " db_host
db_host=${db_host:-localhost}
read -p "Database port (default: 3306): " db_port
db_port=${db_port:-3306}
read -p "Database name (default: mvc_framework): " db_name
db_name=${db_name:-mvc_framework}
read -p "Database user (default: root): " db_user
db_user=${db_user:-root}
read -sp "Database password (leave blank for none): " db_password
echo ""

# Update .env file
sed -i "s/DB_DSN=.*/DB_DSN=\"mysql:host=$db_host;port=$db_port;dbname=$db_name\"/" .env
sed -i "s/DB_USER=.*/DB_USER=\"$db_user\"/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=\"$db_password\"/" .env
echo "Updated .env file with database configuration."

# Run database migrations
echo "Running database migrations..."
php migrations.php

# Navigate to public directory and start the server
echo "Starting the PHP development server on port $PORT..."
cd public
php -S localhost:$PORT &
SERVER_PID=$!

# Wait a moment for the server to start
sleep 2

# Check if the server started successfully
if ps -p $SERVER_PID >/dev/null; then
    echo -e "${GREEN}Setup complete! The application is running at http://localhost:$PORT${NC}"
    echo "You can stop the server by pressing Ctrl+C or running 'kill $SERVER_PID'."
else
    echo -e "${RED}Failed to start the PHP server on port $PORT. Please check for errors and try again.${NC}"
    exit 1
fi