<div class="col-md-12">
    <h1>$Title</h1>
</div>

<div class="col-sm-8">
    <% if $Images %>
        <div class="product-slider slideshow clearfix">
            <% include ProductImages %>
        </div>
    <% end_if %>

    <% if $Content %>
        <div class="clearfix">
            <h3>About this product</h3>
            <div class="typography">
                $Content
            </div>
        </div>
    <% end_if %>

    <% if $Features %>
        <div class="clearfix product-feature-holder">
            <% loop $Features.Sort('SortOrder') %>
                <div class="row typography product-feature<% if $Pos > 2 %> hiddenfeature<% end_if %>">
                    <% if $Image %>
                        <div class="col-sm-6<% if $Even %> col-sm-push-6<% end_if %>">
                            <img src="$Image.URL" alt="$Title" class="img-responsive">
                        </div>
                    <% end_if %>
                    <% if $Image %>
                        <div class="col-sm-6<% if $Even %> col-sm-pull-6<% end_if %>">
                    <% else %>
                        <div class="col-sm-12">
                    <% end_if %>
                    <% if $Title %><h3>$Title</h3><% end_if %>
                    <% if $Content %>$Content<% end_if %>
                    </div>
                </div>
            <% end_loop %>
        </div>
        <% if $Features.Count > 2 %><div class="see-more-features-holder"><a href="#" class="see-more-features"><span>See More Features</span></a></div><% end_if %>
    <% end_if %>

    $Form
    $PageComments
</div>

<div class="col-sm-4">
    <% if $QuickFeatures %>
        <div class="clearfix mb-4">
            <h3>Quick Features</h3>
            <div class="typography">
                $QuickFeatures
            </div>
        </div>
    <% end_if %>

    <% if $Top.ContactForm %>
        <div class="clearfix mb-4">
            <h3>Request Information</h3>
            $Top.ContactForm
        </div>
    <% end_if %>

    <% if $Brochures %>
        <div class="clearfix mb-4">
            <h3>Brochures</h3>
            <% loop $Brochures %>
                <ul>
                    <li class="$FirstLast">
                        <a href="<% if $Download %>$Download.URL<% else_if $FileLink %>$FileLink<% end_if %>" class="small" title="Download $Title" target="_blank" download>$Title - spec sheet</a>
                    </li>
                </ul>
            <% end_loop %>
        </div>
    <% end_if %>
</div>
