<script>
function color_text_change(x){
    for(let i=1;i<10;i++) {
    document.getElementById("social_number"+i).style.color= x;
    text_hover_1 = x ;
}}
</script>
<div id="background-color-option">
                    <h5>Color of Text</h5>
                    <div class="select">
                                        <select onchange="color_text_change(this.value)">
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