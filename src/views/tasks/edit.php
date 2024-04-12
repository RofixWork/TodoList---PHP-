<?php include __DIR__ . '/../layout/header.php' ?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="border px-3 py-3">
                <h3 class="mb-2">Update a new Task</h3>
                <form action="/update" method="post">
                    <input name="task_id" value="<?= $this->task->id ?>" hidden="hidden"/>
                    <div class="mb-3">
                        <label for="task_name" class="form-label">Task Name</label>
                        <input name="task_name" type="text" class="form-control <?= ($this->error ? 'is-invalid' : '') ?>" id="task_name" value="<?= $this->task->task_name ?>">
                        <?php if($this->error): ?>
                            <div id="task_nameFeedback" class="invalid-feedback">
                                Please enter a task name
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="status" id="flexCheckChecked" <?= $this->task->task_status ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexCheckChecked">
                            Complete
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="/" type="submit" class="btn btn-dark">Back</a>
                </form>
            </div>

        </div>
    </div>
</div>
<?php include __DIR__ . '/../layout/footer.php' ?>

