<div class="form" id="social-friend-list">
    <div class="friends-container">
        <div id="social-friend-box"></div>
    </div>
    <button id="gpshare-gift" class="button white medium hidden"></button>
</div>
<script type="text/html" id="fb-template">
    <div class="user-small-ticket-box">
        <input type="hidden" name="id" data-value="id">
        <input type="hidden" name="username" data-value="name">
        <div class="user-small-avatar-container">           
            <img data-src="id" data-format="FbImageFormatter" data-format-target="src" class="img-thumbnail user-small-thumb" alt="User Avatar">
        </div>
        <div class="user-small-vendor-container">
            <span class="small-username" data-content="name"></span>
        </div>
    </div>
</script>
<script type="text/html" id="gp-template">
    <div class="user-small-ticket-box">
        <input type="hidden" name="id" data-value="id">
        <input type="hidden" name="username" data-value="displayName">
        <div class="user-small-avatar-container">           
            <img data-src="image.url" class="img-thumbnail user-small-thumb" alt="User Avatar">
        </div>
        <div class="user-small-vendor-container">
            <span class="small-username" data-content="displayName"></span>
        </div>
    </div>
</script>