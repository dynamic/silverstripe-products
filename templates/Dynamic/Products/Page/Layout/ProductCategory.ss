<div class="row">
    <div class="col-md-12 mt-3">
        $Breadcrumbs
    </div>
</div>
<div class="row">
    <div class="col">
        <article>
            <h1>$Title</h1>
            <% if $Content %>
                <div class="typography">
                    $Content
                </div>
            <% end_if %>
        </article>
    </div>
</div>
<div class="row product-list">
    <% if $ProductPaginatedList %>
        <% loop $ProductPaginatedList %>
            <% include ProductSummary %>
        <% end_loop %>
        <% with $ProductPaginatedList %>
            <% include Pagination %>
        <% end_with %>
    <% else %>
        <p>Sorry, there are currently no products. Please refine your search or check back soon.</p>
    <% end_if %>
</div>
