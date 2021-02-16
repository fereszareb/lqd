<script>
function color_name_change(x){
    document.getElementById("username_visible").style.color= x;
}
</script>
<div id="background-color-option">
                    <h5>Username color</h5>
                    <div class="select">
                                        <select onchange="color_name_change(this.value)">
                                            <option value="<?php echo($et2['text_color']) ?>">Select a color :</option>
                                            <option value="red">Red</option>
                                            <option value="blue">Blue</option>
                                            <option value="green">Green</option>
                                            <option value="pink">Pink</option>
                                            <option value="yellow">Yellow</option>
                                            <option value="black">Black</option>
                                            <option value="white">White</option>
                                        </select>
                    </div>
            </div>