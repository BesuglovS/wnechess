<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container alert alert-info alert-block"><a :href="prefix + '/Tournaments'">Список турниров</a></div>

                <div class="card">
                    <div class="card-header">
                        <span style="margin-right: 1em;">
                            Дерево соревнования <strong>"{{tournament.name}}"</strong>
                        </span>
                    </div>

                    <div class="card-body">
                        <div class="wrapper">
                            <tournament-tree-node v-for="finalNode in finalNodes"
                                                  v-bind:key="finalNode.node_id"
                                                  :node_id="finalNode.node_id"
                                                  :name="finalNode.name"
                                                  :game_id="finalNode.game_id"
                                                  :pgn="finalNode.pgn"
                                                  :player1Name="finalNode.pl1Name"
                                                  :player1Id="finalNode.player1_id"
                                                  :player2Name="finalNode.pl2Name"
                                                  :player2Id="finalNode.player2_id"
                                                  :result="finalNode.result"
                                                  :childNodes="nodesList[finalNode.node_id]"
                                                  :prefix="prefix"
                            >
                            </tournament-tree-node>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import TournamentTreeNode from './TournamentTreeNode';

    export default {
        name: "TournamentTree",
        props: [
            'prefix',
            'player',
            'tournament',
            'tournamentNodes'
        ],
        components: {
            TournamentTreeNode
        },
        data() {
            return {
                finalNodes: [],
                nodesList: {},
            }
        },
        mounted() {
            let fNodes = this.tournamentNodes.filter(n => n.parent_id == null);
            this.finalNodes = fNodes;

            this.nodesList = {};

            for (const key in fNodes) {
                let node = fNodes[key];

                let list = [];
                let result = [];
                list.push(node.node_id);

                while(list.length !== 0) {
                    let listItem = list.pop();
                    let ch = this.tournamentNodes.filter(n => n.parent_id == listItem);

                    for(const childKey in ch) {
                        let child = ch[childKey];
                        result.push(child.node_id);
                        let ch2 = this.tournamentNodes.filter(n => n.parent_id == child.node_id);
                        if (ch2.length !== 0) {
                            list.push(child.node_id);
                        }
                    }
                }

                this.nodesList[node.node_id] = this.tournamentNodes.filter(n => result.includes(n.node_id));
            }
        },
    }
</script>

<style scoped>

</style>
