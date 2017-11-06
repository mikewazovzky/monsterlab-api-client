<a href="/home" class="btn btn-xs btn-success">Home</a>

<a href="/login" class="btn btn-xs btn-primary">Login</a>

<?php if (isset($_SESSION['access_token'])) : ?>
    <a href="/logout" class="btn btn-xs btn-info">Logout</a>

    <a href="/user" class="btn btn-xs btn-primary">Get User Data</a>

    <?php if (isset($_SESSION['user'])) : ?>
        <a href="/user/clear" class="btn btn-xs btn-info">Clear User Data</a>
    <?php endif; ?>

    <a href="/posts" class="btn btn-xs btn-primary">Get Posts Data</a>

    <?php if (isset($_SESSION['posts'])) : ?>
        <a href="/posts/clear" class="btn btn-xs btn-info">Clear Posts Data</a>
    <?php endif; ?>

    <a href="/clear" class="btn btn-xs btn-danger">Clear All</a>

    <div class="checkbox">
        <label>
            <input type="checkbox" v-model="showBuilder"> Builder
        </label>
    </div>
<?php endif; ?>
