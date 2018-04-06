angular.module("uib/template/pagination/pagination.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("uib/template/pagination/pagination.html",
    "<li ng-if=\"::boundaryLinks\" ng-class=\"{disabled: noPrevious()||ngDisabled}\" class=\"page-item pagination-first\"><a href class=\"page-link\" ng-click=\"selectPage(1, $event)\" ng-disabled=\"noPrevious()||ngDisabled\" uib-tabindex-toggle><i class=\"material-icons\">first_page</i></a></li>\n" +
    "<li ng-if=\"::directionLinks\" ng-class=\"{disabled: noPrevious()||ngDisabled}\" class=\"page-item pagination-prev\"><a href class=\"page-link\" ng-click=\"selectPage(page - 1, $event)\" ng-disabled=\"noPrevious()||ngDisabled\" uib-tabindex-toggle><i class=\"material-icons\">chevron_left</i></a></li>\n" +
    "<li ng-repeat=\"page in pages track by $index\" ng-class=\"{active: page.active,disabled: ngDisabled&&!page.active}\" class=\"page-item pagination-page\"><a href class=\"page-link\" ng-click=\"selectPage(page.number, $event)\" ng-disabled=\"ngDisabled&&!page.active\" uib-tabindex-toggle>{{page.text}}</a></li>\n" +
    "<li ng-if=\"::directionLinks\" ng-class=\"{disabled: noNext()||ngDisabled}\" class=\"page-item pagination-next\"><a href class=\"page-link\" ng-click=\"selectPage(page + 1, $event)\" ng-disabled=\"noNext()||ngDisabled\" uib-tabindex-toggle><i class=\"material-icons\">chevron_right</i></a></li>\n" +
    "<li ng-if=\"::boundaryLinks\" ng-class=\"{disabled: noNext()||ngDisabled}\" class=\"page-item pagination-last\"><a href class=\"page-link\" ng-click=\"selectPage(totalPages, $event)\" ng-disabled=\"noNext()||ngDisabled\" uib-tabindex-toggle><i class=\"material-icons\">last_page</i></a></li>\n" +
    "");
}]);
