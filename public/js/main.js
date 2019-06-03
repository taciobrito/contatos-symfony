var app = angular.module('app', []);

app.constant('config', {
  appurl: 'http://localhost:8003/',
	options: {
    headers: { 
      // 'Access-Control-Allow-Origin': '*',
      'Content-Type': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    }
  }
	});

	app.controller('listaContatosController', function ($scope, $http, config) {
	  $scope.contatos = [];

	  var getContatos = function () {
      $http.get(`${config.appurl}contatos/api/list`)
        .then((res) => {
          $scope.contatos = res.data;
        })
        .catch((error) => {
          console.log(error.response);
        })
      }

      getContatos()
	});

	app.controller('salvaEnderecoController', function ($scope, $http, config) {
		$scope.addEndereco = function (endereco) {
			$http.post(`${config.appurl}enderecos/store`, endereco)
				.then((res) => {
            if (res.status == 201) {
              alert('Endereço cadastrado!');
              window.location.href = '/enderecos';
            }
	        })
	        .catch((error) => {
            console.log(error);
            alert('Houve um erro ao tentar adicionar');
	        })
		}
	});