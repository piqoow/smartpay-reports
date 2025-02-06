<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Add New IoT Form</h1>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('iot/submit'); ?>" method="post">
        <div class="form-group">
            <label for="location_name">Location Name</label>
            <select class="form-control" name="location_name" id="location_name" required>
                <?php foreach($locations as $location): ?>
                    <option value="<?= $location->nama_Lokasi ?>" <?= set_select('nama_Lokasi', $location->nama_Lokasi); ?>><?= $location->nama_Lokasi ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="server_category">Server Category</label>
            <select class="form-control" name="server_category" id="server_category" required>
                <option value="">Select Server Category</option>
                <option value="Linux Server20">Linux Server 20</option>
                <option value="Linux Server22">Linux Server 22</option>
                <option value="Windows Server">Windows Server</option>
            </select>
        </div>

        <div class="form-group">
            <label for="ip_address">IP Address</label>
            <input type="text" class="form-control" id="ip_address" name="reporter_ip_address" placeholder="IP Address" required>
            <input type="text" class="form-control" id="ip_address" name="reporter_ip_address" placeholder="Port IOT" required>
        </div>

        <div class="form-group">
            <label for="ip_address">IP Address</label>
            <input type="text" class="form-control" id="ip_address" name="reporter_ip_address" required>
        </div>

        <div class="form-group">
            <label for="setup_date">Setup Date</label>
            <input type="date" class="form-control" id="setup_date" name="setup_date" required>
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
