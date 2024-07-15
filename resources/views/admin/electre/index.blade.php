@extends('layouts.app')

@section('title', 'Perhitungan Electre')

@section('content')
    <section class="section">
        <div class="section-header mb-3">
            <h3>Perhitungan Electre</h3>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">

                    {{-- Bobot --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Bobot</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            @foreach ($criterias as $criteria)
                                                <th>{{ $criteria->code }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($criterias as $criteria)
                                                <td>{{ $criteria->weight }}</td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Data penentuan Sampel--}}
                    {{-- Matrik Keputusan --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Data Penentuan Sampel</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Alternatif</th>
                                            @foreach ($comparisonSubCriterias->groupBy('criteria_id') as $criteriaId => $groupedMatrices)
                                                <?php
                                                if ($groupedMatrices->count() > 0) {
                                                    $criteria = $criterias->where('id', $criteriaId)->first();
                                                }
                                                ?>
                                                <th>{{ $criteria->code }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $totalTiapKolomVertical = [];

                                        // Inisialisasi array total untuk setiap kolom
                                        foreach ($criterias as $criteria) {
                                            if (!isset($totalTiapKolomVertical[$criteria->id])) {
                                                $totalTiapKolomVertical[$criteria->id] = 0;
                                            }
                                        }
                                        ?>

                                        @foreach ($comparisonSubCriterias->groupBy('patient_id') as $patientId => $groupedPatients)
                                            <?php
                                            if ($groupedPatients->count() > 0) {
                                                $patient = $patientCriterias->where('id', $patientId)->first();
                                                if ($patient->patient->name == null) {
                                                    continue;
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td>{{ $patient->patient->name }}</td>
                                                @foreach ($groupedPatients as $patient)
                                                    <?php
                                                    $criteria = $criterias->where('id', $patient->criteria_id)->first();
                                                    $totalTiapKolomVertical[$patient->criteria_id] = $totalTiapKolomVertical[$patient->criteria_id] + pow($patient->value, 2);
                                                    ?>
                                                    <td>{{ $patient->value ?? '' }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Matrik Ternormalisasi --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Data Penentuan Sampel Ternormalisasi</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Alternatif</th>
                                            @foreach ($comparisonSubCriterias->groupBy('criteria_id') as $criteriaId => $groupedMatrices)
                                                <?php
                                                if ($groupedMatrices->count() > 0) {
                                                    $criteria = $criterias->where('id', $criteriaId)->first();
                                                }
                                                ?>
                                                <th>{{ $criteria->code }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($comparisonSubCriterias->groupBy('patient_id') as $patientId => $groupedPatients)
                                            <?php
                                            if ($groupedPatients->count() > 0) {
                                                $patient = $patientCriterias->where('id', $patientId)->first();
                                                if ($patient->patient->name == null) {
                                                    continue;
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td>{{ $patient->patient->name }}</td>
                                                @foreach ($groupedPatients as $patient)
                                                    <?php
                                                    $criteria = $criterias->where('id', $patient->criteria_id)->first();
                                                    $value = $patient->value / sqrt($totalTiapKolomVertical[$patient->criteria_id]);
                                                    ?>
                                                    <td>{{ number_format($value, 6) }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Pembobotan Matrix Ternormalisasi --}}
                    @php
                        $matrixWeighted = [];
                    @endphp
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Pembobotan Matrix Ternormalisasi</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Alternatif</th>
                                            @foreach ($comparisonSubCriterias->groupBy('criteria_id') as $criteriaId => $groupedMatrices)
                                                <?php
                                                if ($groupedMatrices->count() > 0) {
                                                    $criteria = $criterias->where('id', $criteriaId)->first();
                                                }
                                                ?>
                                                <th>{{ $criteria->code }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($comparisonSubCriterias->groupBy('patient_id') as $patientId => $groupedPatients)
                                            <?php
                                            if ($groupedPatients->count() > 0) {
                                                $patient = $patientCriterias->where('id', $patientId)->first();
                                                if ($patient->patient->name == null) {
                                                    continue;
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td>{{ $patient->patient->name }}</td>
                                                @foreach ($groupedPatients as $patient)
                                                    <?php
                                                    $criteria = $criterias->where('id', $patient->criteria_id)->first();
                                                    // dd($criteria);
                                                    $value = $patient->value / sqrt($totalTiapKolomVertical[$patient->criteria_id]);
                                                    $weight = $criteria->weight * $value;
                                                    $matrixWeighted[$patient->patient_id][$criteria->id] = [
                                                        'id' => $criteria->id,
                                                        'weight' => $weight,
                                                    ];
                                                    ?>
                                                    <td>{{ number_format($weight, 6) }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Himpunan Concordance dan Discordance --}}
                    <div class="row">
                        <div class="col-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4>Himpunan Concordance</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Kriteria</th>
                                                    <th>Hitung Concordance</th>
                                                    <th>Himpunan</th>
                                                    <th>Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($matrixWeighted as $i => $matrixWeightedI)
                                                    @foreach ($matrixWeighted as $j => $matrixWeightedJ)
                                                        @if ($i != $j)
                                                            <tr>
                                                                <td>A{{ $i }} >= A{{ $j }}</td>
                                                                <td>
                                                                    @php
                                                                        $idCriterias = [];
                                                                    @endphp
                                                                    {{-- Mencari kriteria yang memenuhi himpunan concordance --}}
                                                                    @foreach ($matrixWeighted[$i] as $k => $matrixWeightedK)
                                                                        @php
                                                                            if (
                                                                                $matrixWeightedK['weight'] >=
                                                                                $matrixWeighted[$j][$k]['weight']
                                                                            ) {
                                                                                $idCriterias[] = $k;
                                                                            }
                                                                            echo $matrixWeightedK['weight'] >=
                                                                            $matrixWeighted[$j][$k]['weight']
                                                                                ? '1'
                                                                                : '0';
                                                                        @endphp
                                                                    @endforeach
                                                                    {{-- End Mencari kriteria yang memenuhi himpunan concordance --}}
                                                                </td>
                                                                <td>
                                                                    {{-- Menampilkan kriteria yang memenuhi himpunan concordance --}}
                                                                    @if ($idCriterias)
                                                                        @foreach ($idCriterias as $idCriteria)
                                                                            @php
                                                                                $criteria = $criterias
                                                                                    ->where('id', $idCriteria)
                                                                                    ->first();
                                                                                echo $criteria->code . ', ';
                                                                            @endphp
                                                                        @endforeach
                                                                    @else
                                                                        <span>Tidak ada</span>
                                                                    @endif
                                                                    {{-- End Menampilkan kriteria yang memenuhi himpunan concordance --}}
                                                                </td>
                                                                <td>
                                                                    {{-- Menampilkan nilai concordance --}}
                                                                    @if ($idCriterias)
                                                                        @php
                                                                            $value = 0;
                                                                        @endphp
                                                                        @foreach ($idCriterias as $idCriteria)
                                                                            @php
                                                                                $criteria = $criterias
                                                                                    ->where('id', $idCriteria)
                                                                                    ->first();
                                                                                $value += $criteria->weight;
                                                                            @endphp
                                                                        @endforeach
                                                                        <span>{{ $value }}</span>
                                                                    @else
                                                                        <span>0</span>
                                                                    @endif
                                                                    {{-- End Menampilkan nilai concordance --}}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4>Himpunan Disordance</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Kriteria</th>
                                                    <th>Hitung Disordance</th>
                                                    <th>Himpunan</th>
                                                    <th>Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($matrixWeighted as $i => $matrixWeightedI)
                                                    @foreach ($matrixWeighted as $j => $matrixWeightedJ)
                                                        @if ($i != $j)
                                                            <tr>
                                                                <td>A{{ $i }} < A{{ $j }}</td>
                                                                <td>
                                                                    @php
                                                                        $idCriterias = [];
                                                                    @endphp
                                                                    {{-- Mencari kriteria yang memenuhi himpunan disordance --}}
                                                                    @foreach ($matrixWeighted[$i] as $k => $matrixWeightedK)
                                                                        @php
                                                                            if (
                                                                                $matrixWeightedK['weight'] <
                                                                                $matrixWeighted[$j][$k]['weight']
                                                                            ) {
                                                                                $idCriterias[] = $k;
                                                                            }
                                                                            echo $matrixWeightedK['weight'] <
                                                                            $matrixWeighted[$j][$k]['weight']
                                                                                ? '1'
                                                                                : '0';
                                                                        @endphp
                                                                    @endforeach
                                                                    {{-- End Mencari kriteria yang memenuhi himpunan disordance --}}
                                                                </td>
                                                                <td>
                                                                    {{-- Menampilkan kriteria yang memenuhi himpunan disordance --}}
                                                                    @if ($idCriterias)
                                                                        @foreach ($idCriterias as $idCriteria)
                                                                            @php
                                                                                $criteria = $criterias
                                                                                    ->where('id', $idCriteria)
                                                                                    ->first();
                                                                                echo $criteria->code . ', ';
                                                                            @endphp
                                                                        @endforeach
                                                                    @else
                                                                        <span>Tidak ada</span>
                                                                    @endif
                                                                    {{-- End Menampilkan kriteria yang memenuhi himpunan disordance --}}
                                                                </td>
                                                                <td>
                                                                    {{-- Menampilkan nilai concordance --}}
                                                                    @if ($idCriterias)
                                                                        @php
                                                                            $value = 0;
                                                                        @endphp
                                                                        @foreach ($idCriterias as $idCriteria)
                                                                            @php
                                                                                $criteria = $criterias
                                                                                    ->where('id', $idCriteria)
                                                                                    ->first();
                                                                                $value += $criteria->weight;
                                                                            @endphp
                                                                        @endforeach
                                                                        <span>{{ $value }}</span>
                                                                    @else
                                                                        <span>0</span>
                                                                    @endif
                                                                    {{-- End Menampilkan nilai concordance --}}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Matrik Concordance --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Matrik Concordance</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Alternatif</th>
                                            @foreach ($comparisonSubCriterias->groupBy('patient_id') as $patientId => $groupedPatients)
                                                <?php
                                                if ($groupedPatients->count() > 0) {
                                                    $patient = $patientCriterias->where('id', $patientId)->first();
                                                    if ($patient->patient->name == null) {
                                                        continue;
                                                    }
                                                }
                                                ?>
                                                <th>{{ $patient->patient->name }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($matrixWeighted as $i => $matrixWeightedI)
                                            <tr>
                                                <td>A{{ $i }}</td>
                                                @foreach ($matrixWeighted as $j => $matrixWeightedJ)
                                                    @if ($i != $j)
                                                        @php
                                                            $idCriterias = [];
                                                        @endphp
                                                        @foreach ($matrixWeightedI as $k => $matrixWeightedK)
                                                            @if ($matrixWeightedK['weight'] >= $matrixWeightedJ[$k]['weight'])
                                                                @php
                                                                    $idCriterias[] = $k;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                        @if ($idCriterias)
                                                            @php
                                                                $value = 0;
                                                            @endphp
                                                            @foreach ($idCriterias as $idCriteria)
                                                                @php
                                                                    $criteria = $criterias
                                                                        ->where('id', $idCriteria)
                                                                        ->first();
                                                                    $value += $criteria->weight;
                                                                @endphp
                                                            @endforeach
                                                            <td>{{ $value }}</td>
                                                        @else
                                                            <td>0</td>
                                                        @endif
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    {{-- @dd($matrixWeighted) --}}
                    {{-- Matrik Discordance --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Matrik Discordance</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Alternatif</th>
                                            @foreach ($comparisonSubCriterias->groupBy('patient_id') as $patientId => $groupedPatients)
                                                <?php
                                                if ($groupedPatients->count() > 0) {
                                                    $patient = $patientCriterias->where('id', $patientId)->first();
                                                    if ($patient->patient->name == null) {
                                                        continue;
                                                    }
                                                }
                                                ?>
                                                <th>{{ $patient->patient->name }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($matrixWeighted as $i => $matrixWeightedI)
                                            <tr>
                                                <td>A{{ $i }}</td>
                                                @foreach ($matrixWeighted as $j => $matrixWeightedJ)
                                                    @if ($i != $j)
                                                        @php
                                                            $idCriterias = [];
                                                            $persatas = [];
                                                            $persbawah = [];
                                                        @endphp
                                                        @foreach ($matrixWeightedI as $k => $matrixWeightedK)
                                                            @if ($matrixWeightedK['weight'] < $matrixWeightedJ[$k]['weight'])
                                                                @php
                                                                    $idCriterias[] = $k;
                                                                @endphp
                                                            @endif
                                                            @php
                                                                $persbawah[$k] = isset($persbawah[$k])
                                                                    ? $persbawah[$k]
                                                                    : 0;
                                                                $persbawah[$k] += abs(
                                                                    $matrixWeightedK['weight'] -
                                                                        $matrixWeightedJ[$k]['weight'],
                                                                );
                                                            @endphp
                                                        @endforeach
                                                        @foreach ($idCriterias as $pi => $criteria)
                                                            @php
                                                                $persatas[$pi] = isset($persatas[$pi])
                                                                    ? $persatas[$pi]
                                                                    : 0;
                                                                $persatas[$pi] += abs(
                                                                    $matrixWeighted[$i][$criteria]['weight'] -
                                                                        $matrixWeighted[$j][$criteria]['weight'],
                                                                );
                                                            @endphp
                                                        @endforeach
                                                        @php
                                                            $maxAtas = !empty($persatas) ? max($persatas) : 0;
                                                            $maxBawah = !empty($persbawah) ? max($persbawah) : 0;
                                                            $bagi = round($maxAtas / $maxBawah, 4);
                                                        @endphp
                                                        <td>
                                                            {{ $bagi }}
                                                        </td>
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Matriks Dominan Concordance --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Matriks Dominan Concordance</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Alternatif</th>
                                            @foreach ($comparisonSubCriterias->groupBy('patient_id') as $patientId => $groupedPatients)
                                                <?php
                                                if ($groupedPatients->count() > 0) {
                                                    $patient = $patientCriterias->where('id', $patientId)->first();
                                                    if ($patient->patient->name == null) {
                                                        continue;
                                                    }
                                                }
                                                ?>
                                                <th>{{ $patient->patient->name }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $jumlahAlternatif = count($matrixWeighted);
                                            $m = $jumlahAlternatif * ($jumlahAlternatif - 1);
                                            $totalValue = 0;
                                            foreach ($matrixWeighted as $i => $matrixWeightedI) {
                                                foreach ($matrixWeighted as $j => $matrixWeightedJ) {
                                                    if ($i != $j) {
                                                        $idCriterias = [];
                                                        foreach ($matrixWeightedI as $k => $matrixWeightedK) {
                                                            if (
                                                                $matrixWeightedK['weight'] >=
                                                                $matrixWeightedJ[$k]['weight']
                                                            ) {
                                                                $idCriterias[] = $k;
                                                            }
                                                        }
                                                        if (!empty($idCriterias)) {
                                                            foreach ($idCriterias as $idCriteria) {
                                                                $criteria = $criterias
                                                                    ->where('id', $idCriteria)
                                                                    ->first();
                                                                $totalValue += $criteria->weight; // Summing up the value into $totalValue
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            $tresholdC = $totalValue / $m;
                                        @endphp
                                        @foreach ($matrixWeighted as $i => $matrixWeightedI)
                                            <tr>
                                                <td>A{{ $i }}</td>
                                                @foreach ($matrixWeighted as $j => $matrixWeightedJ)
                                                    @if ($i != $j)
                                                        @php
                                                            $idCriterias = [];
                                                            $value = 0;
                                                        @endphp
                                                        @foreach ($matrixWeightedI as $k => $matrixWeightedK)
                                                            @if ($matrixWeightedK['weight'] >= $matrixWeightedJ[$k]['weight'])
                                                                @php
                                                                    $idCriterias[] = $k;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                        @if ($idCriterias)
                                                            @foreach ($idCriterias as $idCriteria)
                                                                @php
                                                                    $criteria = $criterias
                                                                        ->where('id', $idCriteria)
                                                                        ->first();
                                                                    $value += $criteria->weight;
                                                                @endphp
                                                            @endforeach
                                                            <td>{{ $value >= $tresholdC ? 1 : 0 }}</td>
                                                        @else
                                                            <td>0</td>
                                                        @endif
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Matriks Dominan Discordance --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Matriks Dominan Discordance</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Alternatif</th>
                                            @foreach ($comparisonSubCriterias->groupBy('patient_id') as $patientId => $groupedPatients)
                                                <?php
                                                if ($groupedPatients->count() > 0) {
                                                    $patient = $patientCriterias->where('id', $patientId)->first();
                                                    if ($patient->patient->name == null) {
                                                        continue;
                                                    }
                                                }
                                                ?>
                                                <th>{{ $patient->patient->name }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $jumlahAlternatif = count($matrixWeighted);
                                            $m = $jumlahAlternatif * ($jumlahAlternatif - 1);
                                            $totalValueD = 0;
                                            foreach ($matrixWeighted as $i => $matrixWeightedI) {
                                                foreach ($matrixWeighted as $j => $matrixWeightedJ) {
                                                    if ($i != $j) {
                                                        $idCriterias = [];
                                                        foreach ($matrixWeightedI as $k => $matrixWeightedK) {
                                                            if (
                                                                $matrixWeightedK['weight'] >=
                                                                $matrixWeightedJ[$k]['weight']
                                                            ) {
                                                                $idCriterias[] = $k;
                                                            }
                                                        }
                                                        $persatas = [];
                                                        foreach ($idCriterias as $pi => $criteria) {
                                                            if (!isset($persatas[$pi])) {
                                                                $persatas[$pi] = 0;
                                                            }
                                                            $persatas[$pi] += abs(
                                                                $matrixWeighted[$i][$criteria]['weight'] -
                                                                    $matrixWeighted[$j][$criteria]['weight'],
                                                            );
                                                        }
                                                        $maxAtas = !empty($persatas) ? max($persatas) : 0;
                                                        $persbawah = [];
                                                        foreach ($matrixWeightedI as $k => $matrixWeightedK) {
                                                            if (!isset($persbawah[$k])) {
                                                                $persbawah[$k] = 0;
                                                            }
                                                            $persbawah[$k] += abs(
                                                                $matrixWeightedK['weight'] -
                                                                    $matrixWeightedJ[$k]['weight'],
                                                            );
                                                        }
                                                        $maxBawah = !empty($persbawah) ? max($persbawah) : 0;
                                                        $bagi = round($maxAtas / $maxBawah, 4);
                                                        $totalValueD += $bagi;
                                                    }
                                                }
                                            }
                                            $tresholdD = $totalValueD / $m;
                                        @endphp
                                        @foreach ($matrixWeighted as $i => $matrixWeightedI)
                                            <tr>
                                                <td>A{{ $i }}</td>
                                                @foreach ($matrixWeighted as $j => $matrixWeightedJ)
                                                    @if ($i != $j)
                                                        @php
                                                            $idCriterias = [];
                                                        @endphp
                                                        @foreach ($matrixWeightedI as $k => $matrixWeightedK)
                                                            @if ($matrixWeightedK['weight'] < $matrixWeightedJ[$k]['weight'])
                                                                @php
                                                                    $idCriterias[] = $k;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                        {{-- {{ json_encode($idCriterias) }} --}}
                                                        {{-- rumus --}}
                                                        @php
                                                            $persatas = [];
                                                            foreach ($idCriterias as $pi => $criteria) {
                                                                if (!isset($persatas[$pi])) {
                                                                    $persatas[$pi] = 0;
                                                                }
                                                                $persatas[$pi] += abs(
                                                                    $matrixWeighted[$i][$criteria]['weight'] -
                                                                        $matrixWeighted[$j][$criteria]['weight'],
                                                                );
                                                            }
                                                            $maxAtas = !empty($persatas) ? max($persatas) : 0;
                                                        @endphp
                                                        @php
                                                            $persbawah = [];
                                                            foreach ($matrixWeightedI as $k => $matrixWeightedK) {
                                                                if (!isset($persbawah[$k])) {
                                                                    $persbawah[$k] = 0;
                                                                }
                                                                $persbawah[$k] += abs(
                                                                    $matrixWeightedK['weight'] -
                                                                        $matrixWeightedJ[$k]['weight'],
                                                                );
                                                            }
                                                            $maxBawah = !empty($persbawah) ? max($persbawah) : 0;
                                                            $bagi = round($maxAtas / $maxBawah, 4);
                                                        @endphp
                                                        <td>
                                                            {{ $bagi >= $tresholdD ? 1 : 0 }}
                                                        </td>
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Matriks Agregat --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Matriks Agregat</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Alternatif</th>
                                            @foreach ($comparisonSubCriterias->groupBy('patient_id') as $patientId => $groupedPatients)
                                                <?php
                                                if ($groupedPatients->count() > 0) {
                                                    $patient = $patientCriterias->where('id', $patientId)->first();
                                                    if ($patient->patient->name == null) {
                                                        continue;
                                                    }
                                                }
                                                ?>
                                                <th>{{ $patient->patient->name }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($matrixWeighted as $i => $matrixWeightedI)
                                            <tr>
                                                <td>A{{ $i }}</td>
                                                @foreach ($matrixWeighted as $j => $matrixWeightedJ)
                                                    @if ($i != $j)
                                                        @php
                                                            $idCriteriasC = [];
                                                            $idCriteriasD = [];
                                                            $value = 0;
                                                        @endphp
                                                        @foreach ($matrixWeightedI as $k => $matrixWeightedK)
                                                            @if ($matrixWeightedK['weight'] >= $matrixWeightedJ[$k]['weight'])
                                                                @php
                                                                    $idCriteriasC[] = $k;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                        @foreach ($matrixWeightedI as $k => $matrixWeightedK)
                                                            @if ($matrixWeightedK['weight'] < $matrixWeightedJ[$k]['weight'])
                                                                @php
                                                                    $idCriteriasD[] = $k;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                        {{-- {{ json_encode($idCriteriasD) }} --}}
                                                        {{-- rumus --}}
                                                        @foreach ($idCriteriasC as $idCriteria)
                                                            @php
                                                                $criteria = $criterias
                                                                    ->where('id', $idCriteria)
                                                                    ->first();
                                                                $value += $criteria->weight;
                                                            @endphp
                                                        @endforeach
                                                        @php
                                                            $persatas = [];
                                                            foreach ($idCriteriasD as $pi => $criteria) {
                                                                if (!isset($persatas[$pi])) {
                                                                    $persatas[$pi] = 0;
                                                                }
                                                                $persatas[$pi] += abs(
                                                                    $matrixWeighted[$i][$criteria]['weight'] -
                                                                        $matrixWeighted[$j][$criteria]['weight'],
                                                                );
                                                            }
                                                            $maxAtas = !empty($persatas) ? max($persatas) : 0;
                                                        @endphp
                                                        @php
                                                            $persbawah = [];
                                                            foreach ($matrixWeightedI as $k => $matrixWeightedK) {
                                                                if (!isset($persbawah[$k])) {
                                                                    $persbawah[$k] = 0;
                                                                }
                                                                $persbawah[$k] += abs(
                                                                    $matrixWeightedK['weight'] -
                                                                        $matrixWeightedJ[$k]['weight'],
                                                                );
                                                            }
                                                            $maxBawah = !empty($persbawah) ? max($persbawah) : 0;
                                                            $bagi = round($maxAtas / $maxBawah, 4);
                                                        @endphp
                                                        <td>
                                                            {{ ($bagi >= $tresholdD ? 1 : 0) * ($value >= $tresholdC ? 1 : 0) }}
                                                        </td>
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Penentuan Ranking</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Alternatif</th>
                                            <td>Jumlah</td>
                                            <td>Ranking</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $ranking = [];
                                            foreach ($matrixWeighted as $i => $matrixWeightedI) {
                                                $totalSum = 0;
                                                foreach ($matrixWeighted as $j => $matrixWeightedJ) {
                                                    if ($i != $j) {
                                                        $idCriteriasC = [];
                                                        $idCriteriasD = [];
                                                        $value = 0;
                                                        foreach ($matrixWeightedI as $k => $matrixWeightedK) {
                                                            if (
                                                                $matrixWeightedK['weight'] >=
                                                                $matrixWeightedJ[$k]['weight']
                                                            ) {
                                                                $idCriteriasC[] = $k;
                                                            } elseif (
                                                                $matrixWeightedK['weight'] <
                                                                $matrixWeightedJ[$k]['weight']
                                                            ) {
                                                                $idCriteriasD[] = $k;
                                                            }
                                                        }
                                                        foreach ($idCriteriasC as $idCriteria) {
                                                            $criteria = $criterias->where('id', $idCriteria)->first();
                                                            $value += $criteria->weight;
                                                        }
                                                        $persatas = [];
                                                        foreach ($idCriteriasD as $pi => $criteria) {
                                                            $persatas[$pi] = isset($persatas[$pi]) ? $persatas[$pi] : 0;
                                                            $persatas[$pi] += abs(
                                                                $matrixWeighted[$i][$criteria]['weight'] -
                                                                    $matrixWeighted[$j][$criteria]['weight'],
                                                            );
                                                        }
                                                        $maxAtas = !empty($persatas) ? max($persatas) : 0;
                                                        $persbawah = [];
                                                        foreach ($matrixWeightedI as $k => $matrixWeightedK) {
                                                            $persbawah[$k] = isset($persbawah[$k]) ? $persbawah[$k] : 0;
                                                            $persbawah[$k] += abs(
                                                                $matrixWeightedK['weight'] -
                                                                    $matrixWeightedJ[$k]['weight'],
                                                            );
                                                        }
                                                        $maxBawah = !empty($persbawah) ? max($persbawah) : 0;
                                                        $bagi = round($maxAtas / $maxBawah, 4);
                                                        $totalSum += $value - $bagi;
                                                    }
                                                }
                                                $ranking[$i] = $totalSum;
                                            }
                                            arsort($ranking);
                                            $no = 1;
                                        @endphp

                                        @foreach ($ranking as $key => $value)
                                            <tr>
                                                <td>A{{ $key }}</td>
                                                <td>{{ $value }}</td>
                                                <td>{{ $no++ }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
