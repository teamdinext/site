Angular.module('groups', [])

/* ----------------------------------------------------------------------------
 *
 *
 * groupCtrl
 *
 *
 * this controller handles the group name and detail editing process
 *
 */
.controller('groupCtrl', function($scope, $http) {
  
  var URL = './groups.php?id=' + classId;

  /*
   * fns() 
   *
   * functions to be applied to each team object for controlling data
   * TODO: implement check for altered data 
   *
   */
  function fns(def) {
    var edit = def?def:false;
    return {
      edit: function() { return edit },
      toggleEdit: function() { edit = !edit }
    }
  }

  /*
   * processResponse() 
   *
   * callback to add fns() methods to response entries
   *
   */
  function processResponse(response) {
    console.log('Server response successful');
    console.log(response.data);

    if(response.data.length > 0)
      var data = response.data;
    if(data) {
      var l = data.length;
      for(i = 0; i < l; i++) {
        var functionlist = fns();
        for(entry in functionlist)
          data[i][entry] = functionlist[entry];
      }
    }

    $scope.teams = data;
  }

  /* AJAX call to the server to delete pages */
  $http({
    method: "GET",
    url: URL 
  }).then(processResponse,
    function(response) {
    console.log('failed');
    console.log(response);
    });

  /* 
   * submit() 
   * 
   * submits loops through teams, sending all updated team data to server
   * TODO: add check for updated content
   */
  $scope.submit = function() {
    console.log('// submit  ');

    var url = 'updatesql.php';
    function successFn(response) {
      window.location.href="../classedit/index.php?id=" + classId;
    }
    function failFn(response) {
      // executed igf $http fails
    }

    var teams = $scope.teams;
    var l = teams.length;
    for(i = 0; i < l; i++) {  
      $http({
        method: "POST",
        url: url,
        data: teams[i]
      }).then(successFn,failFn);
  
    }

  }

});
