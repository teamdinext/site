angular.module('classView', [])

/* ----------------------------------------------------------------------------
 *
 *
 * stageCtrl
 *
 *
 * this controller handles the stage progression of the registration process
 *
 */
.controller('stageCtrl', function($scope, $http) {
    var stage = this;

    /*
     * This json object stores all of the course data that gets
     * passed to the database. All arrays within this object
     * contain data that will be passed to the table its key
     * describes. Eg. stage.classData.team contains an array with
     * the data for each team within a course. This will be a big
     * object.
     * TO DO: implement arrays within stage.classData
     */
    stage.classData = {
        'ClassID': 0,
        'TeachID': null, // overwritten in PHP script as TeachID in session
        'CourseCode': null,
        'CourseName': null,
        'NoOfGroups': 1,
        'IsCanvasEnabled': 'false',
        'World': 'Dragon'
    };
    $scope.scale = [10,20,30,40,50,60,70,80];
    stage.group = new Array();

    $scope.groupNum = 0;
    $scope.stuNum = 0;
    // value for current stage
    stage.current = 1;
    stage.testing = true;
    if(stage.testing) stage.review = true;

    stage.x = 3;

    stage.setIsCanvasEnabled = function(bool) {
        stage.classData.IsCanvasEnabled = bool;
    }

    /*
     * These two functions increment and decrement the value for
     * the current stage. They moves the user forward and backwards
     * in the class registration.
     */
    stage.next = function(){stage.current = ++stage.current;}
    stage.prev = function(){stage.current = --stage.current;}

    /* These functions provide data verification on a stage-by-stage
     * basis, calling the .next function if that stage's data
     * requrements have been met.
     */

    stage.next1 = function() {
        if (stage.classData.CourseCode == null)
            alert("Please enter a Class Code before proceeding!");
        else
            stage.next();
    }

    stage.fin = function(){stage.current = 'fin';}

    /* ------------------------------------------------------------------------
     *
     * finalizing functions
     *
     * these functions are are called when the proceed button is pressed
     *
     */

    /*
     * sends data in POST request to addclass.php. If successful, call
     * addScale to add the scale data to the class. Else, log an error.
     */
    stage.addClass = function() {

        console.log('// adding class');
        // insert records into class table
        var data = stage.classData;
        //data = JSON.stringify(data);

        stage.classData.NoOfGroups =
            $scope.groupNum?$scope.groupNum:$scope.stuNum;
        stage.classData.scale = $scope.scale;
        function successFn(response) {
          if(response.data == 'success')
            window.location.href = '../classedit/?id=' + id;
            return true;
        }
        function failFn(response) {
          // if fail
        }

        $http({
          method: 'POST',
          data: data,
          url: './addclass.php',

        /*
         * .then() takes two arguments: a function to call if successful and a
         * function to call if unsuccessful. The argument of these functions
         * (called response here) spits back the response from addclass.php.
         * In the case of the addclass.php script, the response is the ClassID
         * of the newly inserted class. To let addScale() know what the ID of
         * our new class is, we pass it as an argument in the function.
         */
        }).then(successFn,failFn);
    }

    // tables code
    var Tables = function() {
        var tables = new Object();
        var html = '';

        tables.hasGroups = false;
        tables.disallowGroups = function() {
            tables.hasGroups = false;
        }
        tables.allowGroups = function() {
            tables.hasGroups = true;
        }

        tables.stuNum = 0;
        tables.groupNum = 0;

        return tables;
    }
    stage.tables = Tables();

    // end stageCtrl
})

/* ----------------------------------------------------------------------------
 *
 *
 * gradingCtrl
 *
 *
 * this controller handles the grading stage of the registration process
 * we might not even need this
 *
 */
.controller('gradingCtrl', function($scope) {

    // end gradingCtrl
})
.filter('html', ['$sce', function($sce) {

    /*
     * 'html' is a function made to comply with a standard set by Angular
     * that requires data bound to an HTML element to be 'cleaned' for
     * security or neatness.
     * TODO: add some actual cleaning processes
     * TODO: figure out what $sce is
     */
    return function(text) {
        return $sce.trustAsHtml(text);
    }
}]);
