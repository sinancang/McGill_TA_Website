
 <div class="form-container ajax-content-container">
    <div class='form-wrapper modal edit-user-info-form'>
        <div class="sign-up-form">
            <form method="post" name="form" action="../utils/rateTASubmission.php" style="padding-left: 5%;">
                <p style="font-size: 15px;">Select a term:</p>
                <select id = "term" name ="term" onchange="termSelected(this.value)"class="drop form-select"> 
                    <option> -- Select a term --</option>
                    <option> FALL 2020 </option>
                    <option> WINTER 2021 </option>
                    <option> FALL 2021 </option>
                    <option> WINTER 2022 </option>
                </select>
                <p style="font-size: 15px;">Select a TA from the options:</p>
                <select class="drop form-select" id = "TA_dropdown" name="TA_dropdown">
                    <option value="">-- Select a TA --</option>
                </select>
                <p style="font-size: 15px;">Give a score for TA (1: lowest, 5: highest)</p>
                <select  class="drop form-select" id = "score" name="score">
                    <option>-- Select a rating --</option>
                    <option> 1 </option>
                    <option> 2 </option>
                    <option> 3 </option>
                    <option> 4 </option>
                    <option> 5 </option>
                </select>

                <p style="font-size: 15px;">Leave a review:</p>
                <textarea id = "review" name="review" class="text-area" rows="5" style="width: 95%;"></textarea><br>
                <button id="button" style="background-color: #d77171;" type="submit" onclick="sendCourseRequest()">Submit Review</button>  
            </form>
        </div>
    </div>
</div>       