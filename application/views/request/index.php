<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Request Form</h1>
    <form action="<?= base_url('request/submit_request'); ?>" method="post" enctype="multipart/form-data">
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
            <label for="location">Location Name</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="form-group">
            <label for="request_date">Request Date</label>
            <input type="date" class="form-control" id="request_date" name="request_date" required>
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
                <option value="High">High - 2 Days</option>
                <option value="Medium">Medium - 4 Days</option>
                <option value="Low">Low 6 - Days</option>
            </select>
        </div>
        <div class="form-group">
            <label for="request_title">Request Title</label>
            <input class="form-control" id="request_title" name="request_title" required></input>
        </div>
        <div class="form-group">
            <label for="request_description">Request Description</label>
            <textarea class="form-control" id="request_description" name="request_description" rows="4" required></textarea>
        </div>

        <!-- Tambahkan Form Upload File -->
        <div class="form-group">
            <label for="file">Upload File</label>
            <input type="file" class="form-control" id="file" name="file" accept="application/pdf,image/*,.doc,.docx,.xls,.xlsx,.txt">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
