<% if $Images %>
    <div class="flexslider detail">
        <ul class="slides" role="flexslider">
            <% loop $Images %>
            <li role="slide">
                <% if $ClassName == "SilverStripe\Assets\File" %>
                    <video controls>
                        <source src="$URL" type="video/mp4">
                    </video>
                <% else %>
                    <img src="$URL" alt="<% if $Title %>$Title<% end_if %>">
                <% end_if %>
            </li>
            <% end_loop %>
        </ul>
    </div>
<% end_if %>
