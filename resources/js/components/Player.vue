<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span style="margin-right: 1em;">
                            Игрок
                        </span>
                    </div>

                    <div class="card-body">
                        <div class="container" style="align-items: center; display: flex; justify-content: center;">
                            <table style="margin: 10px" class="table td-center is-bordered">
                                <tr>
                                    <th>Имя</th>
                                    <th>Группа</th>
                                    <th>Рейтинг</th>
                                    <th># игр</th>
                                    <th>Результаты</th>
                                    <th>Средний рейтинг оппонента</th>
                                </tr>

                                <tr>
                                    <td>{{player.name}}</td>
                                    <td>{{player.group}}</td>
                                    <td>{{player.rating}}</td>
                                    <td>{{player.gamesPlayed}}</td>
                                    <td>{{player.wins}}/{{player.draws}}/{{player.losses}}</td>
                                    <td>{{player.averageOpponentRating}}</td>
                                </tr>
                            </table>
                        </div>

                        <table style="margin: 10px" class="table td-center is-bordered">
                            <tr style="text-align: center;">
                                <th>Белые</th>
                                <th>Рейтинг белых</th>
                                <th>Чёрные</th>
                                <th>Рейтинг чёрных</th>
                                <th>Результат</th>
                                <th>Дата</th>
                                <th>Турнир</th>
                                <th>PGN</th>
                            </tr>

                            <tr v-for="playerGame in playerGames"
                                :class="((player.id == playerGame.pl1Id && playerGame.result == 1) || (player.id == playerGame.pl2Id && playerGame.result == -1)) ? 'gameWon' :
                                (((player.id == playerGame.pl1Id && playerGame.result == -1) || (player.id == playerGame.pl2Id && playerGame.result == 1)) ? 'gameLost' : 'gameDraw')
                                 ">
                                <td :class="player.id == playerGame.pl1Id ? 'bold' : ''">{{playerGame.pl1Name}}</td>
                                <td>{{playerGame.player1RatingBefore}} / {{playerGame.player1RatingAfter}}</td>
                                <td :class="player.id == playerGame.pl2Id ? 'bold' : ''">{{playerGame.pl2Name}}</td>
                                <td>{{playerGame.player2RatingBefore}} / {{playerGame.player2RatingAfter}}</td>
                                <td>{{playerGame.result == 1 ? "1:0" : ((playerGame.result == 0) ? "1/2:1/2" : "0:1")}}</td>
                                <td>{{reformatDateTime(playerGame.date)}}</td>
                                <td>{{playerGame.tournamentName}}</td>
                                <td>
                                    <a v-if="playerGame.pgn != ''"
                                       :href="prefix + '/Game/' + playerGame.id">Открыть PGN</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from "moment";

    export default {
        name: "Player",
        props: [
            'player',
            'playerGames',
            'prefix'
        ],
        methods: {
            reformatDate(date) {
                return date.substr(8,2) + '.' + date.substr(5,2) + '.' + date.substr(0,4);
            },
            reformatDateTime(date) {
                return moment(date, 'YYYY-MM-DD HH:mm:ss').format('DD.MM.YYYY HH:mm:ss');
            },
        },
    }
</script>

<style scoped>
    .gameWon {
        background-color: rgba(50,255,41,0.1);
    }

    .gameLost {
        background-color: rgba(255,2,51,0.1);
    }

    .gameDraw {
        background-color: rgba(255,255,255,0.1);
    }

    .bold {
        font-weight: 700;
    }
</style>
