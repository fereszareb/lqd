
<script>
function width_social(x){
    for(let i=1;i<10;i++) {
    document.getElementById("social_number"+i).style.width= x;
}}
</script>


<div id="background-color-option">
                    <h5>Width</h5>
                    <div class="select">
                                        <select onchange="width_social(this.value)">
                                            <option value="<?php echo($et2['social_width']) ?>">Select a porcentage :</option>
                                            <option value="30%">30%</option>
                                            <option value="40%">40%</option>
                                            <option value="50%">50%</option>
                                            <option value="60%">60%</option>
                                            <option value="70%">70%</option>
                                            <option value="80%">80%</option>
                                            <option value="90%">90%</option>
                                            <option value="100%">100%</option>
                                        </select>
                    </div>
            </div>