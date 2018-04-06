<div class="modal-header">
<h3 class="modal-title" id="modal-title" ng-bind="vm.formData.title"></h3>
</div>
<div class="modal-body" id="modal-body">

<div ng-bind="vm.formData.message"></div>

</div>


</div>
<div class="modal-footer">
<button class="btn btn-primary" type="button" ng-click="vm.ok()">OK</button>
</div>