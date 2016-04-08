angular.module('teamPoints', [])
/* ----------------------------------------------------------------------------
 *
 *
 * teamsCtrl
 *
 *
 * This controller manages team data dynamically for inputting points.
 *
 */
.controller('teamsCtrl', function($scope, $http) {
  var teams = this;
    var url = './teamsql.php?id=' + id;
    $scope.id=id;

    teams.list = [
        {name: 'Group 1',
         teamId: 4,
         points: 23},
        {name: 'Group 2',
         teamId: 4,
         points: 23},
        {name: 'Group Three',
         teamId: 4,
         points: 23},
        {name: 'Group Fore',
         teamId: 4,
         points: 23}
    ];

    var Fn = function() {


        this.notEditing = true;

        this.enableEdit = function() {
            this.notEditing = false;
        }
        this.disableEdit = function() {
            this.notEditing = true;
        }
        return this;
    }

    /*
     * POST course ID to url and get JSON response. Translate JSON to the list
     * of team objects. Add edit functions to each object.
     */

    function getTeams() {
            $http({
                method: "POST",
                url: url,
                data: id
            }).then(function(response) {
                    console.log('success');

                    // process each object within response and add fn functions
                    var data = response.data;
                    var responseLength = data.length;
                    for(var i = 0; i < responseLength; i++)
                    {
                        data[i].prototype = new Fn();
                        data[i].prototype.disableEdit();

                    }
                    teams.list = response.data;
                console.log(response);
                console.log(teams.list);
                //window.location.href="../classlist/";
            }, function(response) {
                    console.log('failed');
                console.log(response);
            });
    }
    getTeams();
    
    function updatePoints(team) 
    {   
        console.log("updatePoints function called.")
        var url = 'updatesql.php';
        function successFn(response) {
            // executed if $http successful
        }
        function failFn(response) {
            // executed igf $http fails
        }
        $http({
                method: "POST",
                url: url,
                data: team
            }).then(successFn,failFn);
    }
    
    teams.buttonSubmit = function($event) {
            var teamsBool = false;
            for (i=0; i < teams.list.length; i++)
            {
            if (!teams.list[i].prototype.notEditing)
                   teamsBool = true;
            }
            if (teamsBool == true)
                alert("Please ensure that all of the text boxes are grayed out and that you are done changing point totals before submitting your points!");
            else
            {
                teams.list.forEach(updatePoints);
                window.location = "../classedit/index.php?id=" + id;
            }
        }
    teams.return = function($event) {
        window.location = "../classedit/index.php?id=" + id;
    }
}
);
