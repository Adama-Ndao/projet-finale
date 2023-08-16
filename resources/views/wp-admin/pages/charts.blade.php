@include('wp-admin/Menue')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="row">
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Pourcentage des Projets</h4>
            <!-- Ajouter une div pour entourer le canvas du graphique -->
            <div style="width: 100%; height: 300px;">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>
    <div class="col-md-8 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-row justify-content-between">
            <h4 class="card-title mb-1">Diagramme des utilisateurs</h4>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="chart-container" style="position: relative; height:400px;">
                <canvas id="userChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="col-md-8 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-row justify-content-between">
            <!-- <h4 class="card-title mb-1">Diagramme des utilisateurs inscrits avec Google</h4> -->
          </div>
          <div class="row">
            <div class="col-12">
              
            </div>
          </div>
        </div>
      </div>
    </div>



  <!-- <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Diagrames</h4>
          <div class="table-responsive">
            Digrammes
          </div>
        </div>
      </div>
    </div>
  </div> -->

  
  <script>
    var enCours = {!! json_encode($projetencours) !!};
    var termines = {!! json_encode($projets_termines) !!};
    var totalProjets = enCours.length + termines.length;

    var pourcentageEnCours = (enCours.length / totalProjets) * 100;
    var pourcentageTermines = (termines.length / totalProjets) * 100;

    var data = {
        labels: ['En cours', 'Terminés'],
        datasets: [{
            label: 'Pourcentage de projets',
            data: [pourcentageEnCours, pourcentageTermines],
            backgroundColor: ['rgb(54, 162, 235)', 'rgb(75, 192, 192)'],
        }]
    };
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie', // Utiliser le type 'pie' pour le diagramme circulaire
        data: data,
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                },
                // Pour afficher les pourcentages dans les tooltips
                tooltips: {
                    callbacks: {
                        label: function (context) {
                            var label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.formattedValue + '%'; // Ajouter le symbole de pourcentage
                            return label;
                        }
                    }
                }
            }
        }
    });
</script>







<script>
  var simpleUsers = {!! json_encode($simpleUsers) !!}; // Tableau des utilisateurs inscrits
  var googleUsers = {!! json_encode($googleUsers) !!}; // Tableau des utilisateurs inscrits avec Google

  // Fonction pour obtenir le nombre d'utilisateurs inscrits par sexe
  function countUsersBySex(users, sexe) {
    return users.filter(user => user.sexe === sexe).length;
  }

  // Données pour le diagramme des utilisateurs inscrits
  var userData = {
    'hommes': countUsersBySex(simpleUsers, 'homme'),
    'femmes': countUsersBySex(simpleUsers, 'femme')
  };

  // Données pour le diagramme des utilisateurs inscrits avec Google
  var googleUserData = {
    'homme': countUsersBySex(googleUsers, 'homme'),
    'femme': countUsersBySex(googleUsers, 'femme')
  };

  var data = {
    labels: Object.keys(userData), // Sexe comme étiquettes de l'axe X
    datasets: [{
      label: 'Nombre d\'utilisateurs inscrits',
      data: Object.values(userData), // Valeurs du nombre d'utilisateurs inscrits par sexe
      backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(255, 99, 132, 0.7)'], // Couleurs de remplissage des barres
      borderColor: ['rgb(54, 162, 235)', 'rgb(255, 99, 132)'], // Couleurs de bordure des barres
      borderWidth: 1 // Largeur de la bordure des barres
    }]
  };

  var googleUserData = {
    labels: Object.keys(googleUserData), // Sexe comme étiquettes de l'axe X
    datasets: [{
      label: 'Nombre d\'utilisateurs inscrits avec Google',
      data: Object.values(googleUserData), // Valeurs du nombre d'utilisateurs inscrits avec Google par sexe
      backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(255, 99, 132, 0.7)'], // Couleurs de remplissage des barres
      borderColor: ['rgb(54, 162, 235)', 'rgb(255, 99, 132)'], // Couleurs de bordure des barres
      borderWidth: 1 // Largeur de la bordure des barres
    }]
  };

  var ctx = document.getElementById('userChart').getContext('2d');
  var userChart = new Chart(ctx, {
    type: 'bar', // Utiliser le type 'bar' pour le diagramme en barres
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true // Commencer l'axe Y à 0
        }
      }
    }
  });

  var googleCtx = document.getElementById('googleUserChart').getContext('2d');
  var googleUserChart = new Chart(googleCtx, {
    type: 'bar', // Utiliser le type 'bar' pour le diagramme en barres
    data: googleUserData,
    options: {
      scales: {
        y: {
          beginAtZero: true // Commencer l'axe Y à 0
        }
      }
    }
  });
</script>






  @include('wp-admin/Menuef')