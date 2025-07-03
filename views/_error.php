<?php
/** @var $exception \Exception */
?>

<div
        style="background-color: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); max-width: 600px; width: 90%; margin: 40px auto; text-align: center;">
    <h1 style="font-size: 8em; color: #dc3545; margin-bottom: 0; line-height: 1;"><?php echo $exception->getCode(); ?></h1>
    <h2 style="font-size: 2em; color: #343a40; margin-top: 10px; margin-bottom: 20px;"><?php echo $exception->getMessage(); ?></h2>
    <p style="font-size: 1.1em; color: #6c757d; line-height: 1.6;">
        Page Not Found or You are not authorized to access
    </p>
    <p style="font-size: 1.1em; color: #6c757d; line-height: 1.6; margin-bottom: 30px;">
        Please check the URL for any typos or navigate back to the homepage.
    </p>
    <a href="/"
       style="display: inline-block; padding: 12px 25px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; transition: background-color 0.3s ease; box-shadow: 0 2px 5px rgba(0, 123, 255, 0.2);">Go
        to Homepage</a>
</div>