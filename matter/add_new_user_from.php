<div id="close-veil-btn">❌</div>
<div class="form-wrapper modal add-new-user-form">
    <div class="form-input-container">
        <label for="name">Name</label>
        <input type="text" name="name" id="new-user-name" required>
    </div>

    <div class="form-input-container">
        <label for="email">Email</label>
        <input type="text" name="email" id="new-user-email" required>
    </div>


    <div class="form-input-container">
        <label for="type">User Type</label>
        <select name="type" id="new-user-type" class="form-select-input">
            <option value="admin">Admin</option>
            <option value="prof">Professor</option>
        </select>
    </div>

    <button class="submit-btn" id="submit-add-new-user-btn" type="button">Add</button>
    <div class="new-user-server-response"></div>
</div>