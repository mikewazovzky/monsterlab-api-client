<div class="panel panel-default auth">
    <div class="panel-heading">
        Authentcation data
    </div>

    <div class="panel-body">
        <form class="form-horizontal">
            <div class="form-group form-group-sm">
                <label for="id" class="col-sm-3">client_id</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="id" placeholder="<?php echo(session('client_id')); ?>" disabled>
                </div>
            </div>

            <div class="form-group form-group-sm">
                <label for="secret" class="col-sm-3">client_secret</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="secret" placeholder="<?php echo(session('client_secret')); ?>" disabled>
                </div>
            </div>

            <div class="form-group form-group-sm">
                <label for="token" class="col-sm-3">access_token</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="token" placeholder="<?php echo(session('access_token')); ?>" disabled>
                </div>
            </div>

            <?php if ($user = session('user')) : ?>
                <div class="form-group form-group-sm">
                    <label for="id" class="col-sm-3">User ID</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="id" placeholder="<?php echo($user['id']); ?>" disabled>
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label for="name" class="col-sm-3">User Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="name" placeholder="<?php echo($user['name']); ?>" disabled>
                    </div>
                </div>

                <div class="form-group form-group-sm">
                    <label for="email" class="col-sm-3">User Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" name="email" placeholder="<?php echo($user['email']); ?>" disabled>
                    </div>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>
