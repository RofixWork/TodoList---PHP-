<?php include __DIR__ . '/../layout/header.php' ?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="border px-3 py-3">
                <h3 class="mb-2">Create a new Task</h3>
                <form action="/store" method="post">
                    <div class="mb-3">
                        <label for="task_name" class="form-label">Task Name</label>
                        <input name="task_name" type="text" class="form-control <?= ($this->error ? 'is-invalid' : '')?>" id="task_name">
                        <?php if($this->error): ?>
                            <div id="task_nameFeedback" class="invalid-feedback">
                                Please enter a task name
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                    <a href="/" type="submit" class="btn btn-dark">Back</a>
                </form>
            </div>

        </div>
    </div>
</div>
<?php include __DIR__ . '/../layout/footer.php' ?>

