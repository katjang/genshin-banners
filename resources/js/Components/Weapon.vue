<script setup lang="ts">
import { Banner, Weapon } from '@/models';
import { WeaponType } from '@/models';
import Counter from '@/Components/Counter.vue';
import BannerList from '@/Components/BannerList.vue';

const props = defineProps<{
    weapon: Weapon,
}>();

defineEmits(['click-character', 'click-weapon']);

let banners: {[key: string]: Banner[]} = {};

if(props.weapon.banners != undefined) {
    banners = props.weapon.banners.reduce((group: {[key: string]: Banner[]}, banner) => {
        const { end_date } = banner;
        group[end_date.toString()] = group[end_date.toString()] ?? [];
        group[end_date.toString()].push(banner);
        return group;
    }, {});
}

</script>

<template>
    <div class="position-absolute w-100 h-100 top-0 left-0">
        <v-img
            :src="`/images/icons/weapon_types/` + weapon.weapon_type + `.png`"
            cover
            eager
            width="100%"
            style="position: absolute; filter: blur(10px)"
        ></v-img>
        <v-sheet color="#000000AA" class="position-absolute w-100 h-100 top-0 left-0"></v-sheet>
    </div>
    <div style="position: relative;">
        <h2 class="text-h2 d-flex align-end">
            <div>
                <v-avatar size="75">
                    <v-img
                        :src="`/images/portraits/` + weapon.name.replace(' ', '_') + `_Icon.png`"
                        cover
                        eager
                    ></v-img>
                </v-avatar>
            </div>
            {{ weapon.name }}
            <div v-if="weapon.banners && weapon.banners.length > 0" class="text-h4 ml-6">
                <Counter 
                    :start_date="new Date(weapon.banners[0].end_date)"
                    :row="true"
                />
            </div>
        </h2>
        <v-card-subtitle class="text-capitalize text-h5 pl-0" style="margin-left: 75px">
            <img :src="`/images/icons/rarity/` + weapon.rarity + `.png`">
            {{ WeaponType[weapon.weapon_type].toLowerCase() }}
        </v-card-subtitle>
        
        <BannerList :banners="weapon.banners" @click-character="$emit('click-character', $event)" @click-weapon="$emit('click-weapon', $event)"/>
    </div>
</template>