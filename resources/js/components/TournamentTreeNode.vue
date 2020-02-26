<template>
    <div class="item head-item">
        <div :class="{
            'item-parent': ((this.root) || (this.childNodes.length !== 0)),
            'item-child': ((this.childNodes.length == 0) && (!this.root)),
            'parent-with-children': (this.childNodes.length !== 0)
        }">
            <div class="nodeBox" style="display: flex; flex-direction: column;">
                <div :class="{'winner' : result === 1, 'loser' : result === -1, 'drawn' : result === 0}">
                    <a :href="prefix + '/Player/' + player1Id">
                        {{player1Name}}
                    </a>
                </div>
                <div :class="{'winner' : result === -1, 'loser' : result === 1, 'drawn' : result === 0}">
                    <a :href="prefix + '/Player/' + player2Id">
                        {{player2Name}}
                    </a>
                </div>
                <div class="gameName">
                    <a v-if="game_id !== null" :href="prefix + '/Game/' + game_id">
                        {{name}} <span v-if="pgn !==''">(pgn)</span>
                    </a>
                    <div v-if="game_id == null">
                        {{name}}
                    </div>
                </div>
            </div>
        </div>
        <div v-if="childNodes.length !== 0" class="item-childrens">
            <div v-for="childNode in directDescendantNodes" class="item-child">
                <tournament-tree-node v-bind:key="childNode.node_id"
                                      :node_id="childNode.node_id"
                                      :name="childNode.name"
                                      :game_id="childNode.game_id"
                                      :pgn="childNode.pgn"
                                      :player1Name="childNode.pl1Name"
                                      :player1Id="childNode.player1_id"
                                      :player2Name="childNode.pl2Name"
                                      :player2Id="childNode.player2_id"
                                      :result="childNode.result"
                                      :childNodes="nodesList[childNode.node_id]"
                                      :prefix="prefix"
                                      :root=false
                >
                </tournament-tree-node>
            </div>
        </div>
    </div>
</template>

<script>
    import TournamentTreeNode from './TournamentTreeNode';

    export default {
        name: "TournamentTreeNode",
        props: [
            'node_id',
            'name',
            'game_id',
            'pgn',
            'player1Name',
            'player1Id',
            'player2Name',
            'player2Id',
            'result',
            'childNodes',
            'prefix',
            'root'
        ],
        components: {
            TournamentTreeNode
        },
        data() {
            return {
                nodesList: {},
                directDescendantNodes: [],
            }
        },
        mounted() {
            this.nodesList = {};
            this.directDescendantNodes = this.childNodes.filter(n => n.parent_id == this.node_id);

            for (const key in this.directDescendantNodes) {
                let node = this.childNodes[key];

                let list = [];
                let result = [];
                list.push(node.node_id);

                while(list.length !== 0) {
                    let listItem = list.pop();
                    let ch = this.childNodes.filter(n => n.parent_id == listItem);

                    for(const childKey in ch) {
                        let child = ch[childKey];
                        result.push(child.node_id);
                        let ch2 = this.childNodes.filter(n => n.parent_id == child.node_id);
                        if (ch2.length !== 0) {
                            list.push(child.node_id);
                        }
                    }
                }

                this.nodesList[node.node_id] = this.childNodes.filter(n => result.includes(n.node_id));
            }
        },
    }
</script>

<style scoped>
 .winner {
     padding: 5px;
     background-color: #228B2288;
 }

 .loser {
     padding: 5px;
     background-color: #d9534f88;
 }

 .drawn {
     padding: 5px;
     background-color: #385d7a88;
 }
 .gameName {
     padding: 5px;
     background-color: #0088cc88;
 }
</style>
