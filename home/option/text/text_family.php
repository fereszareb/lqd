<script>
function font_family(x){
    for(let i=1;i<10;i++) {

    document.getElementById("socialview"+i).style.fontFamily = x;
}}
</script>




<div id="background-color-option">
                    <h5>Font family</h5>
                    <div class="select">
                                        <select onchange="font_family(this.value)">
                                            <option value="">Select a Style :</option>
                                            <option value="'Arial'">Arial</option>
                                            <option value="'Cambria'">combria</option>
                                            <option value="'cursive'">cursive</option>
                                            <option value="'fantasy'">fantasy</option>
                                            <option value="'monospace'">monospace</option>
                                        </select>
                    </div>
            </div>