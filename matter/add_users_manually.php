<div class="add-users-manually-form-container">

    <form onsubmit="submitAddManuallyForm()" method="POST">

        <div class="form-input-container">
            <label for="new-prof">Professor name</label>
            <input type="text" name="new-prof" id="new-prof" required>
        </div>

        <div class="form-input-container">
            <label for="course-code">Course code</label>
            <input type="text" name="course-code" id="course-code" required>
        </div>

        <div class="form-example">
            <input type="submit" value="Add">
        </div>

    </form>

</div>