<template>
    <tag-list v-model="initialList"></tag-list>
</template>

<script>

function cloneArray(arr){
    return arr.reduce(function(agg, val){
        return agg.concat(val);
    }, [])
}

export default {
name: 'tag-list',
    model:{
    prop:'taglist',
        event:'input'
},
props:{
    taglist:{
        type: Array,
    default:undefined
    },
    isolatedTaglist:{
        type: Array,
    default:[]
    }
},
data(){
    return {
        tags: this.taglist ? cloneArray(this.taglist) : cloneArray(this.isolatedTaglist),
        tag:''
    }
},
methods:{
    characterInput(keyValue){
        var savedInput =  ''
        switch(keyValue.key){
            case 'Enter': savedInput = this.tag; break;
            case ' ':
            case ',':
            case ';':
                savedInput = this.tag.substring(0, this.tag.length-1)
                break;
            default: // do nothing
        }
        if(savedInput!=''){
            if(this.tags.indexOf(savedInput) === -1) {
                this.tags.push(savedInput)
                this.tag = ''
                this.$emit('input', cloneArray(this.tags))
            } else {
                this.tag = ''
            }

        }
    },
    removeTag(id){
        this.tags.splice(id, 1)
        this.$emit('input', cloneArray(this.tags))
    }
},
watch:{
    taglist(taglist){
        this.tags = taglist.reduce(function(agg, val){
            return agg.concat(val);
        }, [])
    }
},
template:`
    <div class="tag-list">
      <ul>
        <li class="tag" v-for="(item, key) in tags" :key.number="key">
          <span class="title">{{item}}</span>
          <button class="delete-btn" @click="removeTag(key)">X</button>
        </li>
        <li class="search-box">
          <input type="text" placeholder="Add tag…" v-model="tag" @keyup="characterInput">
        </li>
      </ul>
    </div>
  `
}

</script>

<style scoped>

</style>
