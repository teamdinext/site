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

  classes.isDeleting = false;
  var deletes = new Array();
	var url = 'deleteclasses.php?';
  classes.handleClick = function(id, $event) {
    if(classes.isDeleting)
    {
			deletes.push($event.target.id);
			if(url.match(/\?$/)) x = 2;
			else url += '&';
			url += 'classes[]=' + $event.target.id;
      console.log(url);
    }
    else
      window.location.href = '../classedit/?id=' + id;
    /*
<a href="../classedit/index.php?id=' . $courseId . '&courseCode=' . $courseCode . '">
    */

  }
  classes.beginRemove = function() {
		if(classes.isDeleting == true) {
			console.log('deleting');
			$http({
				method: "GET",
				url: url
			}).then(function(response) {
                console.log('success');
				//window.location.href="../classlist/";
			}, function(response) {
                console.log('failed');
				console.log(response);
			});
			classes.isDeleting = false;
		}
    classes.isDeleting = true;
  }

	classes.toRegister = function() {
		window.location.href="../classregister/";
	}

  classes.btnClass = function(x) {

    return classes.isDeleting||x?'center class-button button-lg faded':'center class-button button-lg';
  }

});
