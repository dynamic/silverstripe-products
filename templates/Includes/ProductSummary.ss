<% if $Product %>
    <div class="col-lg-3 col-md-4 col-6 mb-3 element__promos__item">
        <div class="card h-100">
            <% if $Product.Image %>
                <% if $Link %><a href="$Link" title="Read $Link.Title.ATT"><% end_if %>
                    <img src="$Product.Image.FocusFill(500,330).URL" class="card-img-top" alt="$Image.Title.ATT">
                <% if $Link %></a><% end_if %>
            <% end_if %>
            <div class="card-body">
                <h4 class="card-title">$Product.Title</h4>
                <% if $Link %><div class="card-text"><a href="$Link">Learn more</a></div><% end_if %>
            </div>
        </div>
    </div>
<% end_if %>
