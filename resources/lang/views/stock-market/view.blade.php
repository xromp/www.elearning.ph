
<div class="container" id="mainDiv">
    <p>Stock Market Page</p>
    <div class="list-group" ng-repeat="category in sc.categoryList">
        <a href="stockmarket/category/<%category.category_code%>" class="list-group-item list-group-item-action justify-content-end align-right">
            <div class="mr-auto p-2">
                <h6 class="mb-1" ng-bind="category.description"></h6>
                <small></small>
            </div>                    
            <div>
                <span class="badge badge-default ">Answered: <%category.no_answered%></span>
                <span class="badge badge-default">Unanswered:<%category.no_unanswered%></span>
            </div>
        </a>
        <br>
    </div>
</div>