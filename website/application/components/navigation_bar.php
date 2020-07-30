<div class="header">
    <div class="headerTop">
        <a href="/"><b><?= PROJECT["NAME"] ?></b></a>
        <form action="/search" method="get" class="search">
            <input placeholder="Search" type="text" name="query">
            <select name="query">
                <option value="Users">Users</option>
                <option value="Groups">Groups</option>
                <option value="Blogs">Blogs</option>
            </select>
            <input type="submit" value="Search">
        </form>
    </div>
    <div class="headerBottom">
        <small>
            <?php if (isset($_SESSION["user"])): ?>
                <a href="/">Your Account</a>
            <?php else: ?>
                <a href="/register">Register</a> • <a href="/login.php">Login</a>
            <?php endif; ?>
            
            • <a href="/groups/">Groups</a> • <a href="/blogs/">Blogs</a> • <a href="/jukebox/">Jukebox</a> • <a href="/random">Random</a> • <a href="/users/">Users</a>
        </small>
        
        <?php if (!isset($_SESSION["user"])): ?>
            <small><span style="float: right"> Not logged in. <a href="/login">Log in</a></span></small>
        <?php endif; ?>
    </div>
</div>