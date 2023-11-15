<script setup lang="ts">
import { ref } from 'vue'
import * as countdown from "countdown";

const props = defineProps<{
    start_date: Date;
    row?: Boolean;
}>();

const months = ref(0);
const days = ref(0);
const hours = ref(0);
const minutes = ref(0);
const seconds = ref(0);

let timer = countdown(props.start_date, (ts: any) => {
    months.value = ts.months;
    days.value = ts.days;
    hours.value = ts.hours;
    minutes.value = ts.minutes;
    seconds.value = ts.seconds;
}, countdown.MONTHS|countdown.DAYS|countdown.HOURS|countdown.MINUTES|countdown.SECONDS);

function pad(num: number, size: number): string {
    var s = "00000" + num;
    return s.substring(s.length-size);
}

</script>

<template>
    <div>
        <div v-if="row">
            {{ months }} Months, {{ days }} Days, {{ pad(hours,2) }}:{{ pad(minutes,2) }}:{{ pad(seconds,2) }}
        </div>
        <div v-else>
            <v-row justify="center" class="text-body-1 font-weight-bold" no-gutters>
                <v-col cols="auto" v-if="months" class="px-2">
                    {{ months }} Months
                </v-col>
                <v-col cols="auto" v-if="days" class="px-2">
                    {{ days }} Days
                </v-col>
            </v-row>
            <v-row class="text-body-2 font-weight-bold" no-gutters>
                <v-col class="text-center">
                    {{ pad(hours,2) }}:{{ pad(minutes,2) }}:{{ pad(seconds,2) }}
                </v-col>
            </v-row>
        </div>
    </div>
    
    
</template>
