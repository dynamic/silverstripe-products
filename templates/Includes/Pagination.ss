<% if MoreThanOnePage %>
    <nav aria-label="$MenuTitle.ATT pagination">
        <ul class="pagination justify-content-center">
            <li class="page-item<% if $FirstPage %> disabled<% end_if %>">
                <a href="$PrevLink" class="page-link" aria-label="Previous" title="Go to the previous page">&laquo;</a>
            </li>
            <% loop $PaginationSummary(4) %>
                <% if $CurrentBool %>
                    <li class="page-item active"><span class="page-link">$PageNum <span class="sr-only">(current)</span></span></li>
                <% else %>
                    <% if $Link %>
                        <li class="page-item"><a href="$Link" class="page-link" title="Go to page $PageNum">$PageNum</a></li>
                    <% else %>
                        <em>...</em>
                    <% end_if %>
                <% end_if %>
            <% end_loop %>
            <li class="page-item<% if $LastPage %> disabled<% end_if %>">
                <a href="$NextLink" class="page-link" aria-label="Next" title="Go to the next page">&raquo;</a>
            </li>
        </ul>
    </nav>
<% end_if %>
