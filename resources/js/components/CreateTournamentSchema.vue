<template>
    <div>
        <div class="container alert alert-info alert-block">
            <a :href="prefix + '/adminTournaments'">Список турниров</a> |
            <a :href="prefix + 'Tournament/Graph/' + tournament.id">Схема турнира</a>
        </div>
        <div class="container" style="align-items: center; display: flex; flex-direction: column; justify-content: center;">
            <div>
                <select style="width: 300px" v-model="playerId" name="playerId">
                    <option v-for="player in playerList" :value="player.id">
                        {{player.name}} ({{player.group}}) - {{player.rating}}
                    </option>
                </select>
            </div>

            <button :disabled="loading" @click="addPlayer();" style="font-size: 1em; margin-top: 0.5em;" class="button is-primary">Добавить игрока</button>

            <div class="container" style="align-items: center; display: flex; justify-content: center;">
                <table style="margin: 10px" class="table td-center is-bordered">
                    <tr>
                        <th>Имя</th>
                        <th>Группа</th>
                        <th>Рейтинг</th>
                        <th># игр</th>
                        <th>Результаты</th>
                        <th>Средний рейтинг оппонента</th>
                        <th>Исключить</th>
                    </tr>

                    <tr v-for="player in tournamentPlayerList">
                        <td><a :href="prefix + '/adminPlayer/' + player.id">{{player.name}}</a></td>
                        <td>{{player.group}}</td>
                        <td>{{player.rating}}</td>
                        <td>{{player.gamesPlayed}}</td>
                        <td>{{player.wins}}/{{player.draws}}/{{player.losses}}</td>
                        <td>{{player.averageOpponentRating}}</td>
                        <td>
                            <button @click="removePlayer(player.id);" style="font-size: 1em; margin-top: 0.5em;" class="button is-primary">Исключить</button>
                        </td>
                    </tr>
                </table>
            </div>
            <button :disabled="loading" @click="createNewSchema();" style="font-size: 1em; margin-top: 0.5em;" class="button is-primary">Создать новую схему</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CreateTournamentSchema",
        props: [
            'tournament',
            'players',
            'prefix'
        ],
        data: function () {
            return {
                playerId: -1,
                playerList: (Object.values(this.players)).sort((a,b) => { return b.rating - a.rating;}),
                loading: false,
                tournamentPlayerList: [],

            }
        },
        methods: {
            addPlayer() {
                let player = (this.playerList.filter(p => p.id === this.playerId))[0];
                this.tournamentPlayerList.push(player);
            },
            createNewSchema() {
                let idList = this.tournamentPlayerList.map(p => p.id);
                axios.get(this.prefix + '/adminTournament/createNewSchema?tournamentId=' + this.tournament.id + '&ids=' + idList.join(','), idList);
            },
            removePlayer(id) {
                let removeIndex = this.tournamentPlayerList.map(item => item.id).indexOf(id);
                this.tournamentPlayerList.splice(removeIndex, 1);
            },
        },
    }
</script>

<style scoped>

</style>
