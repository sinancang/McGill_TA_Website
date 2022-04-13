<div class="form-container">

    <div class="form-wrapper">


        <div class="form-input-container">
            <label for="course-code">Course code</label>
            <input type="text" name="course-code" id="course-code" required>
        </div>

        <div class="form-input-container">
            <label for="course-name">Course Name</label>
            <input type="text" name="course-name" id="course-name" required>
        </div>

        <div class="form-input-container">
            <label for="term">Term</label>
            <input type="text" name="term" id="term" required>
        </div>

        <div class="form-input-container">
            <label for="new-prof">Professor name</label>
            <input type="text" name="new-prof" id="new-prof" required>
        </div>



        <button class="submit-btn" id="add-btn" type="button" onclick="submitAddManuallyForm()">Add</button>

    </div>

    <div id="form-server-response-container"></div>

</div>