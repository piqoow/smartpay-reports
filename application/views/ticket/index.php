<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Complaint Form</h1>
    <form action="<?= base_url('complaint/submit_complaint'); ?>" method="post">
        <div class="form-group">
            <label for="name">Reporter Name</label>
            <input type="text" class="form-control" id="name" name="reporter_name" required>
        </div>
        <div class="form-group">
            <label for="email">Reporter Email</label>
            <input type="email" class="form-control" id="email" name="reporter_email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="reporter_phone" required>
        </div>
        <div class="form-group">
            <label for="issue_date">Issue Date</label>
            <input type="date" class="form-control" id="issue_date" name="issue_date" required>
        </div>
        <div class="form-group">
            <label for="category">Division</label>
            <select class="form-control" name="category" id="category" required>
                <option value="Network">Network</option>
                <option value="Parkee System">Parkee System</option>
                <option value="IOT System">IOT System</option>
                <option value="Infra">Infrastructure</option>
                <option value="IT Support">IT Support</option>
            </select>
        </div>
        <div class="form-group">
            <label for="priority">Priority</label>
            <select class="form-control" name="priority" id="priority" required>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>
        </div>
        <div class="form-group">
            <label for="issue_title">Issue Title</label>
            <input class="form-control" id="issue_title" name="issue_title" required></input>
        </div>
        <div class="form-group">
            <label for="issue_description">Issue Description</label>
            <textarea class="form-control" id="issue_description" name="issue_description" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

