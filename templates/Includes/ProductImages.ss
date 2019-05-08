<% if $Images %>
    <div class="flexslider detail">
        <ul class="slides" role="flexslider">
            <% loop $Images %>
            <li role="slide">
                <img src="$URL" alt="<% if $Title %>$Title<% end_if %>">
            </li>
            <% end_loop %>
        </ul>
    </div>
<% end_if %>
