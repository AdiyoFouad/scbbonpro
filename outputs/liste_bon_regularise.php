<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bons à régulariser</title>
</head>
<body>
    
    <div class="entete">
        <div class="left">
            <img src="assets/images/logos/favicon.png" alt="" >
            <p>Société des Ciments du Bénin<br>Ciment Bouclier</p>
        </div>
        <div class="right">
            <h2>Bons provisoires à régulariser</h2>
        </div>    
    </div>
    <div class="contenu">
      <table>
        <thead>
          <th>Date</th>
          <th>N° Bon</th>
          <th>Demandeur</th>
          <th>Désignation des dépenses</th>
          <th>Bénéficiaire</th>
          <th>Montant</th>
          <th>Date d'acquisition des fonds</th>
        </thead>
        <tbody>
          <tr>
            <td>11/03/2024</td>
            <td>DCLI/2024/0001</td>
            <td>H. Magengo</td>
            <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est ipsa hic id aut nemo mollitia porro incidunt quos, necessitatibus corporis doloribus ex fugiat voluptates dolorem!</td>
            <td>DCLI</td>
            <td>12 500 999</td>
            <td>17/03/2024</td>
          </tr>
          <tr>
            <td>11/03/2024</td>
            <td>DCLI/2024/0001</td>
            <td>H. Magengo</td>
            <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est ipsa hic id aut nemo mollitia porro incidunt quos, necessitatibus corporis doloribus ex fugiat voluptates dolorem!</td>
            <td>DCLI</td>
            <td>12 500 999</td>
            <td>17/03/2024</td>
          </tr>
          <tr>
            <td>11/03/2024</td>
            <td>DCLI/2024/0001</td>
            <td>F. Magengo</td>
            <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est ipsa hic id aut nemo mollitia porro incidunt quos, necessitatibus corporis doloribus ex fugiat voluptates dolorem!</td>
            <td>DGA</td>
            <td>12 500 999</td>
            <td>17/03/2024</td>
          </tr>
        </tbody>
      </table>
    </div>
</body>
<style>

  
.entete .left{
        width: 40%;
        display: inline-block;
        float: left;
        text-align:center;
        margin-left:-3.5em;
    }

    .entete .left img{
        width: 150px;
        margin:-1em 0 -1.5em 0;
    }

    .entete .right{
        margin-top: 22px;
        width: 65%;
        float: right;
        font-family: Helvetica;  
    }

    .contenu table{
        width: 100%;
        font-size: 20px;
        border-collapse: collapse;
        border: 0.5px solid black;
        margin-top:8em;
    }

    .contenu table td, .contenu table th{
        border: 0.5px solid black;
    }

    .contenu thead {  
        font-family: Arial, sans-serif;
        font-size: 16px;
        background: rgba(0,0,0, 0.07);
    }

    .contenu table thead th:nth-child(7), .contenu table thead th:nth-child(1), .contenu table thead th:nth-child(2) {
      width:10%;
    }

    .contenu table thead th:nth-child(4) {
      width:35%;
    }

    .contenu table thead th:nth-child(6) {
      width:11%;
    }

    .contenu table td{
      font-family: Arial, sans-serif;
        font-size: 13px;
        text-align: center;
    }
  @page { 
    size: A4 landscape; 
    font-size: 20px;
    }
</style>
</html>