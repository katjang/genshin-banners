<script setup lang="ts">
import { WeaponBanner, Weapon } from '@/models';
import { WeaponType } from '@/models';
import Counter from '@/Components/Counter.vue';
import { getWeaponBannerName } from '@/helpers';

const props = defineProps<{
    weapon: Weapon,
}>();

defineEmits(['click-weapon']);

let banners: {[key: string]: WeaponBanner[]} = {};

if(props.weapon.banners != undefined) {
    banners = props.weapon.banners.reduce((group: {[key: string]: WeaponBanner[]}, banner) => {
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
        
        <v-timeline>
            <v-timeline-item v-for="bannerPeriod in banners" :key="bannerPeriod[0].id">
                <template v-slot:icon v-if="bannerPeriod.length == 1 && bannerPeriod[0].featured">
                    <v-icon>
                        <v-avatar size="60" color="white" :image="`/images/portraits/` + bannerPeriod[0].featured[0].name.replace(' ', '_') + `_Icon.png`"></v-avatar>
                    </v-icon>
                </template>
                <template v-slot:icon v-if="bannerPeriod.length == 2 && bannerPeriod[0].featured && bannerPeriod[1].featured">
                    <v-icon>
                        <v-avatar size="60" color="white">
                            <img style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; clip-path: view-box polygon(0% 0%, 0% 100%, 50% 100%, 50% 0);" :src="`/images/portraits/` + bannerPeriod[0].featured[0].name.replace(' ', '_') + `_Icon.png`">
                            <img style="position absolute; left: 50%; top: 0; width: 100%; height: 100%; clip-path: view-box polygon(50% 0%, 100% 0%, 100% 100%, 50% 100%);" :src="`/images/portraits/` + bannerPeriod[1].featured[0].name.replace(' ', '_') + `_Icon.png`">
                        </v-avatar>
                    </v-icon>
                </template>
                <template v-slot:opposite>
                    <v-chip pill class="mr-1">
                        {{ new Date(bannerPeriod[0].start_date).toLocaleString('en-us',{month:'long', year:'numeric', day: 'numeric'}) }}
                    </v-chip>
                    <v-icon icon="mdi-calendar-collapse-horizontal"></v-icon>
                    <v-chip pill class="ml-1">
                        {{ new Date(bannerPeriod[0].end_date).toLocaleString('en-us',{month:'long', year:'numeric', day: 'numeric'}) }}
                    </v-chip>
                </template>
                <v-card v-for="(banner, key) in bannerPeriod">
                    <v-card-title class="text-h6">
                        {{ getWeaponBannerName(banner) }}
                    </v-card-title>
                    <v-card-text class="bg-white text--primary pt-3">
                        <v-chip v-for="featured in banner.featured" class="ma-1" pill @click="$emit('click-weapon', featured.id)">
                            <v-avatar start>
                                <v-img :src="`/images/portraits/` + featured.name.replace(' ', '_') + `_Icon.png`"></v-img>
                            </v-avatar>
                            {{ featured.name }}
                        </v-chip>
                    </v-card-text>
                </v-card>
            </v-timeline-item>
        </v-timeline>
    </div>
</template>