<div id="carousel-{$ID}" class="carousel slide mb-3">
    <div class="carousel-inner" style="margin-bottom: 100px">
        <% loop $Product.Images.Sort('SortOrder') %>
            <div class="carousel-item<% if $IsFirst %> active<% end_if %>" <% if $Top.Autoplay != "Off" %>data-bs-interval="$Top.IntervalInMilliseconds" <% end_if %>>
                <img src="$FocusFill(1000,600).URL" class="d-block w-100 image-fluid" alt="$Image.Title.XML">
            </div>
        <% end_loop %>
    </div>
    <% if $Product.Images.Count > 1 %>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{$ID}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel-{$ID}" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        <div class="carousel-indicators" style="margin-bottom: -20px;">
            <% loop $Product.Images.Sort('SortOrder') %>
                <button type="button" data-bs-target="#carousel-{$Up.ID}" data-bs-slide-to="{$Pos(0)}"
                    <% if $IsFirst %>class="active" aria-current="true"<% end_if %> aria-label="{$Title.XML}" style="width: 200px;">
                    <img class="d-block w-100"
                    src="$FocusFill(200,140).URL" class="img-fluid" />
                </button>
            <% end_loop %>
        </div>
    <% end_if %>
</div>

