angular.module('classList', [])

/* ----------------------------------------------------------------------------
 *
 *
 * stageCtrl
 *
 *
 * this controller handles the stage progression of the registration process
 *
 */
.controller('classesCtrl', function($scope, $http) {
  var classes = this;
  var hasDeletes = false;
  var deletes = new Array();
  var URL = './getclasses.php';
  $scope.isDeleting = false;

  /*
   * fns()
   *
   * functions to be applied to each class object for controlling data
   * TODO: implement check for altered data
   *
   */
  function fns(def) {
    var removing = def?def:false;
    return {
      removing: function() { return removing },
      toggleRemove: function() { removing = !removing },
      btnClass:  function(x) {
        if($scope.isDeleting)
         if(removing)
          return 'center class-button button-lg';
         else
          return 'center class-button button-lg faded';
        else
          return 'center class-button button-lg';
      },
      handleClick: function(id, $event) {
        if($scope.isDeleting)
        {
          this.toggleRemove();
          hasDeletes = true;
          //console.log(this);
        }
        else
          window.location.href = '../classedit/?id=' + id;
      }
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
        var x = fns();
        for(entry in x)
          data[i][entry] = x[entry];
      }
    }

    $scope.classList = data;
    console.log($scope.classList);
  }

  /* AJAX call to the server to get teams */
  $http({
    method: "GET",
    url: URL
  }).then(processResponse,
    function(response) {
    console.log('failed');
    console.log(response);
    });


  /*
   * processRemoval()
   *
   * function to process click for remove button
   *
   */
  $scope.processRemoval = function() {

    var hasQueue = function() {
      var l = $scope.classList.length;
      for(i = 0; i < l; i++)
        if($scope.classList[i].removing())
          return true;
        else return false;
    }

    var url = 'deleteclasses.php?';

    function successFn(response) {
      if(response.data == 'success')
        window.location.href = './';
    }
    function failFn(response) {
      // if fail
    }

        if($scope.isDeleting == true) {
            if(!hasDeletes) {
                $scope.isDeleting = false;
        var l = $scope.classList.length;
        for(i = 0; i < l; i++)
          if($scope.classList[i].removing())
            $scope.classList[i].toggleRemove();
                return;
      }

      var data = new Array();
      var l = $scope.classList.length;
      for(i = 0; i < l; i++)
        if($scope.classList[i].removing())
          data.push($scope.classList[i].id);

            /* AJAX call to the server to delete pages */
            $http({
                method: "POST",
                url: url,
        data: data
            }).then(successFn,failFn);
            $scope.isDeleting = false;
        }
    $scope.isDeleting = true;


    /*
    if(url.match(/\?$/))
      x = 2;
    else
      url += '&';
    url += 'classes[]=' + $event.target.id;
    console.log(url);

    console.log($event.target.classList);
    $event.target.classList.remove('faded');
    */
  }

  /*
   * removeBtn()
   *
   * determines string value of remove button
   *
   */
  $scope.removeBtn = function() {

    var hasQueue = function() {
      var l = $scope.classList.length;
      for(i = 0; i < l; i++)
        if($scope.classList[i].removing())
          return true;
        else return false;
    }

    if($scope.isDeleting==true)
      if(hasDeletes)
        return 'Remove';
      else return 'Cancel';
    else return 'Remove';
  }

    classes.toRegister = function() {
        window.location.href="../classregister/";
    }


});
