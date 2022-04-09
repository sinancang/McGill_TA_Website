<div class="add-users-manually-form-container">

    <div class="form-wrapper">

        <div class="form-input-container">
            <label for="new-prof">Professor name</label>
            <input type="text" name="new-prof" id="new-prof" required>
        </div>

        <div class="form-input-container">
            <label for="course-code">Course code</label>
            <input type="text" name="course-code" id="course-code" required>
        </div>

        <button id="add-btn" type="button" onclick="submitAddManuallyForm()">Add</button>

    </div>

</div>

<?php 
    if($_GET['view'] == "add-manually-users") {
        echo "<link rel='stylesheet' href='../css/manual_input.css'>";
    }
?>