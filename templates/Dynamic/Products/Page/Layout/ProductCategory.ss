<div class="col-md-10 col-md-offset-1">
    <article>
        <h1>$Title</h1>
        
        <% if $Content %>
            <div class="typography">
                $Content
            </div>
        <% end_if %>
    </article>

    <hr />

    $CollectionSearchForm
    <div class="clearfix"></div>

    <% if $PaginatedList %>
        <div class="product-list row">
            <% loop $PaginatedList %>
                <% include ProductSummary %>
                <% if $MultipleOf(4,1) %><div class="clearfix"></div><% end_if %>
            <% end_loop %>
        </div>
        <% with $PaginatedList %>
            <% include Pagination %>
        <% end_with %>
    <% else %>
        <p>Sorry, there are currently no products. Please refine your search or check back soon.</p>
    <% end_if %>

    $Form
</div>