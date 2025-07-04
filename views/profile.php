<?php /** User: Shenoda */
$user = \app\core\Application::$app->user;

/** @var $this \app\core\View */
$this->title = "profile";
?>
<h1 style="color: #333; text-align: center; margin-bottom: 30px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    Profile</h1>


<style>
    .profile-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        background-color: #f9f9f9;
        border-radius: 16px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    .profile-header {
        text-align: center;
        margin-bottom: 30px;
    }


    .profile-info {
        display: grid;
        row-gap: 15px;
    }

    .profile-info div {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid #ddd;
        padding-bottom: 8px;
    }

    .profile-info div label {
        font-weight: bold;
        color: #666;
    }
</style>

<div class="profile-container">
    <div class="profile-header">
        <h2><?= htmlspecialchars($user->firstname . ' ' . $user->lastname) ?></h2>
        <p><?= htmlspecialchars($user->email) ?></p>
    </div>

    <div class="profile-info">
        <div>
            <label>First Name:</label>
            <span><?= htmlspecialchars($user->firstname) ?></span>
        </div>
        <div>
            <label>Last Name:</label>
            <span><?= htmlspecialchars($user->lastname) ?></span>
        </div>
        <div>
            <label>Email:</label>
            <span><?= htmlspecialchars($user->email) ?></span>
        </div>
        <div>
            <label>Role:</label>
            <span><?= htmlspecialchars($user->role ?? 'User') ?></span>
        </div>
        <div>
            <label>Member Since:</label>
            <span><?= date('F j, Y', strtotime($user->created_at ?? 'now')) ?></span>
        </div>
    </div>
</div>