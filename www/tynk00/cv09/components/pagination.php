<?php

function paginate($page, $total_pages) {
    if($total_pages > 1){
        $prev_page = max($page - 1, 1);
        $next_page = min($page + 1, $total_pages);
        $html = '<nav aria-label="Page navigation example">';
        $html .= '<ul class="pagination mx-auto w-auto" style="max-width: 250px;">';
        $first = ($page == 1) ? 'disabled' : '';
        $html .= '<li class="page-item"><a class="page-link ' . $first . '" href="' . getCurrentUrlWithoutPage() . '?page=' . $prev_page . '">Previous</a></li>';
        for ($i = 1; $i <= $total_pages; $i++) {
            $active_class = ($i == $page) ? ' active' : '';
            $html .= '<li class="page-item'. $active_class .'"><a class="page-link"  href="' . getCurrentUrlWithoutPage() . '?page=' . $i . '">' . $i . '</a></li>';
        }
        $last = ($page == $total_pages) ? 'disabled' : '';
        $html .= '<li class="page-item"><a class="page-link ' . $last . '" href="' . getCurrentUrlWithoutPage() . '?page=' . $next_page . '">Next</a></li>';
        $html .= '</ul>';
        $html .= '</nav>';
        return $html;
    }
    else {
        return '';
    }
    
}


function getCurrentUrlWithoutPage() {
    // Get the current URL
    $url = getCurrentUrlWithoutParams();

    // Remove the 'page' parameter from the query string
    $query_params = array();
    if (isset($_GET)) {
        foreach ($_GET as $key => $val) {
            if ($key != 'page') {
                $query_params[] = urlencode($key) . '=' . urlencode($val);
            }
        }
    }
    
    // Rebuild the URL with the updated query string
    if (count($query_params) > 0) {
        $url .= '?' . implode('&', $query_params);
    }
    
    return $url;
}

?>