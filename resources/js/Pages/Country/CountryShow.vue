<script setup>
import LayoutMain from "@/Layouts/LayoutMain.vue";
import Card from "primevue/card";
import WeightChart from "@/Components/Charts/WeightChart.vue";
import CompanyIndexTable from "@/Components/CompanyIndexTable.vue";
import StatCardGroup from "@/Components/StatCardGroup.vue";
import { useI18n } from "vue-i18n";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";

const props = defineProps({
    country: {
        type: Object,
        required: true
    },
    weightHistory: {
        type: Object,
        required: true
    },
    companies: {
        type: Object,
        required: true
    },
    nextCompaniesPage: {
        type: Number,
        required: true
    }
});

const {n} = useI18n();

const countryStats = [
    {
        title: 'Anzahl Unternehmen',
        value: props.country.companies_count,
    },
    {
        title: 'Gewichtung',
        value: n(Number(props.country.weight), 'percent'),
    }
]

const breadcrumbItems = [
    {
        label: 'Länder',
        route: '/countries'
    },
    {
        label: props.country.name,
        route: null
    },
];
</script>

<template>
    <layout-main>
        <breadcrumbs :items="breadcrumbItems"/>
        <div class="space-y-10">
            <h1 class="text-4xl font-bold">{{ country.name }}</h1>
            <stat-card-group :stats="countryStats"/>
            <card>
                <template #title>
                    <h2 class="text-2xl font-bold">Gewichtung</h2>
                </template>
                <template #content>
                    <weight-chart :data="weightHistory"/>
                </template>
            </card>
            <card>
                <template #title>
                    <h2 class="text-2xl font-bold">Unternehmen</h2>
                </template>
                <template #content>
                    <company-index-table :companies="companies" :next-page="nextCompaniesPage"/>
                </template>
            </card>
        </div>
    </layout-main>
</template>
