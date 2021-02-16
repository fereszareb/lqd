<script>
function background_change_social(x) {
    outt= x ;
    for(let i=1;i<10;i++) {
    document.getElementById("social_number"+i).style.background = x;
}}

</script>




<div id="background-color-option">
                <h5>Background color</h5>
                    <div class="select">
                                        <select onchange="background_change_social(this.value)">
                                            <option value="<?php echo($et2['social_background']) ?>">Select a color :</option>
                                            <option value="red">Red</option>
                                            <option value="blue">Blue</option>
                                            <option value="green">Green</option>
                                            <option value="pink">Pink</option>
                                            <option value="yellow">Yellow</option>
                                            <option value="black">Black</option>
                                            <option value="transparent">None</option>
                                            <option value="#ff6666">Color 1</option>
                                            <option value="#4ada76">Color 2</option>
                                            <option value="#caaed6">Color 3</option>
                                            <option value="#ff9878">Color 4</option>
                                            <option value="#006666">Color 5</option>
                                            <option value="#63a194">Color 6</option>
                                            <option value="#ecdad1">Color 7</option>
                                        </select>
                    </div>
            </div>