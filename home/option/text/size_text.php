<script>
function size_text(x){
    for(let i=1;i<10;i++) {
    document.getElementById("socialview"+i).style.fontSize= x;
}}
</script>



<div id="background-color-option">
                    <h5>Text size</h5>
                    <div class="select">
                                        <select onchange="size_text(this.value)">
                                            <option value="">Select a Size:</option>
                                            <option value="8px">8px</option>
                                            <option value="10px">10px</option>
                                            <option value="12px">12px</option>
                                            <option value="14px">14px</option>
                                            <option value="16px">16px</option>
                                            <option value="18px">18px</option>
                                            <option value="20px">20px</option>
                                            <option value="22px">22px</option>
                                            <option value="24px">24px</option>
                                            <option value="26px">26px</option>
                                            <option value="28px">28px</option>
                                            <option value="30px">30px</option>
                                            <option value="32px">32px</option>
                                        </select>
                    </div>
            </div>