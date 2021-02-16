
<script>
function height_social(x){
    for(let i=1;i<10;i++) {
    document.getElementById("social_number"+i).style.height= x;
}}
</script>

<div id="background-color-option">
                    <h5>Height</h5>
                    <div class="select">
                                        <select onchange="height_social(this.value)">
                                            <option value="<?php echo($et2['social_heigth']) ?>">Select a Style :</option>
                                            <option value="30px">30px</option>
                                            <option value="40px ">40px</option>
                                            <option value="50px">50px</option>
                                            <option value="60px">60px</option>
                                            <option value="70px">70px</option>
                                            <option value="80px">80px</option>
                                            <option value="90px">90px</option>
                                            <option value="100px">100px</option>
                                            <option value="110px">110px</option>
                                        </select>
                    </div>
            </div>