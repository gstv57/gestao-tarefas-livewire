<div class="row">
    <div class="col-md-12">
        <h5>Participantes</h5>
        <div class="user-container">
            @foreach($participantes as $participante)
                <div class="col">
                    <div class="user-card" style="background: white;">
                        <img src="https://via.placeholder.com/40" class="rounded-circle" alt="User 1">
                        <div class="user-info">
                            <p>{{ $participante->name }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <style>
        .user-card {
            display: flex;
            align-items: center;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            margin-bottom: 8px; /* Espaço inferior para itens em linha quebrada */
        }
        .user-card img {
            width: 40px;
            height: 40px;
            object-fit: cover;
        }
        .user-card .user-info {
            margin-left: 12px;
        }
        .user-card .user-info h6 {
            margin: 0;
            font-size: 14px;
        }
        .user-card .user-info p {
            margin: 0;
            font-size: 12px;
            color: #666;
        }
        .user-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2px;
        }
        .user-container .col {
            flex: 0 0 20%; /* Cada item ocupa 20% do contêiner, resultando em 5 itens por linha */
            max-width: 20%; /* Limita o tamanho máximo de cada item para 20% */
        }
        @media (max-width: 768px) {
            .user-container .col {
                flex: 0 0 50%; /* Ajusta para 2 itens por linha em telas menores */
                max-width: 50%;
            }
        }
        @media (max-width: 576px) {
            .user-container .col {
                flex: 0 0 100%; /* Ajusta para 1 item por linha em telas muito pequenas */
                max-width: 100%;
            }
        }
    </style>
</div>
