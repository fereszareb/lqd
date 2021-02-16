
<script>
    function border_image_color(x){
    document.getElementById("img_view").style.borderColor= x;
}
</script>



<div id="background-color-option">
                    <h5>Border color</h5>
                    <div class="select">
                                        <select onchange="border_image_color(this.value)">
                                            <option value="<?php echo($et2['picture_border_color']) ?>">Select a color :</option>
                                            <option value="red">Red</option>
                                            <option value="blue">Blue</option>
                                            <option value="green">Green</option>
                                            <option value="pink">Pink</option>
                                            <option value="yellow">Yellow</option>
                                            <option value="black">Black</option>
                                            <option value="white">White</option>
                                            <option value="#dcedc1">Grey</option>
                                            <option value="#fe9004">Orange</option>
                                            <option value="#8b3c9d">Purple</option>

                                        </select>
                    </div>
            </div>