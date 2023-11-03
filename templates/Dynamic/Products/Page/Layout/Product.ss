<div class="row">
    <div class="col-md-12 mt-3">
        $Breadcrumbs
    </div>
</div>
<div class="row">
    <div class="col-md-7">
        <% if $Product.Images %>
            <% include ProductImages %>
        <% end_if %>
    </div>
    <div class="col-md-5">
        <h4>$CategoryTitle</h4>
        <h1>$Product.Title</h1>
        <div class="typography">
            $Product.Content
        </div>
    </div>
</div>
