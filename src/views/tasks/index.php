<?php include __DIR__ . '/../layout/header.php' ?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Tasks</h3>
                <a href="/create" class="btn btn-primary">Add Task</a>
            </div>
<!--            alert -->
            <?php if(array_key_exists('message_success', $_COOKIE)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_COOKIE['message_success'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
<!--            alert-->
            <div class="p-2 rounded mt-3">
                <?php if(count($this->tasks)): ?>
    <!--                fetch all tasks-->
                    <?php foreach ($this->tasks as $task): ?>
                        <div class="mb-2 border p-2 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0 text-capitalize <?= $task->task_status ? 'text-decoration-line-through' : '' ?>"><?= $task->task_name ?></h5>
                                <p class="text-secondary fw-normal fs-6 mb-0"><?= (new \DateTime($task->updated_at))->format('d/m/y H:i a') ?></p>
                            </div>
                            <div>
                                <a class="btn btn-sm btn-info text-white" href="/edit?taskId=<?= $task->id ?>">Edit</a>
                                <a class="btn btn-sm btn-danger" href="/delete?taskId=<?= $task->id ?>">Delete</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!--                fetch all tasks-->
                <?php else: ?>
                    <h4 class="text-danger">No exist any Tasks</h4>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
<?php include __DIR__ . '/../layout/footer.php' ?>

